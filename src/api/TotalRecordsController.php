<?php

namespace Coroowicaksono\ChartJsIntegration\Api;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Http\Requests\NovaRequest;

class TotalRecordsController extends Controller
{
    use ValidatesRequests;
    /**
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle(NovaRequest $request)
    {
        if ($request->input('model')) {
            $request->merge(['model' => urldecode($request->input('model'))]);
        }
        $showTotal = isset($request->options) ? json_decode($request->options, true)['showTotal'] ?? true : true;
        $dataForLast = isset($request->options) ? json_decode($request->options, true)['latestData'] ?? 3 : 3;
        $unitOfMeasurement = isset($request->options) ? json_decode($request->options, true)['uom'] ?? 'month' : 'month';
        $startWeek = isset($request->options) ? json_decode($request->options, true)['startWeek'] ?? '1' : '1';
        if(!in_array($unitOfMeasurement, ['day', 'week', 'month'])){
            throw new ThrowError('UOM not defined correctly. <br/>Check documentation: https://github.com/coroo/chart-js-integration');
        }
        $calculation = isset($request->options) ? json_decode($request->options, true)['sum'] ?? 1 : 1;
        $request->validate(['model'   => ['bail', 'required', 'min:1', 'string']]);
        $model = $request->input('model');
        $xAxisColumn = $request->input('col_xaxis') ?? 'created_at';
        $cacheKey = hash('md4', $model . (int)(bool)$request->input('expires'));
        $dataSet = Cache::get($cacheKey);
        if (!$dataSet) {
            $labelList = [];
            $xAxis = [];
            $yAxis = [];
            $seriesSql = "";
            $defaultColor = array("#ffcc5c","#91e8e1","#ff6f69","#88d8b0","#b088d8","#d8b088", "#88b0d8", "#6f69ff","#7cb5ec","#434348","#90ed7d","#8085e9","#f7a35c","#f15c80","#e4d354","#2b908f","#f45b5b","#91e8e1","#E27D60","#85DCB","#E8A87C","#C38D9E","#41B3A3","#67c4a7","#992667","#ff4040","#ff7373","#d2d2d2");
            if(isset($request->series)){
                foreach($request->series as $seriesKey => $serieslist){
                    $seriesData = json_decode($serieslist);
                    $filter = $seriesData->filter;
                    $labelList[$seriesKey] = $seriesData->label;
                    $seriesSql .= ", SUM(CASE WHEN ".$filter->key." = '".$filter->value."' then ".$calculation." else 0 end) as '".$labelList[$seriesKey]."'";
                }
            }
            if($unitOfMeasurement=='day'){
                $query = $model::selectRaw('DATE('.$xAxisColumn.') AS cat, DATE('.$xAxisColumn.') AS catorder, sum('.$calculation.') counted'.$seriesSql)
                    ->where($xAxisColumn, '>=', Carbon::now()->subDay($dataForLast+1))
                    ->groupBy('catorder', 'cat')
                    ->orderBy('catorder', 'asc');
            } else if($unitOfMeasurement=='week'){
                $query = $model::selectRaw('YEARWEEK('.$xAxisColumn.', '.$startWeek.') AS cat, YEARWEEK('.$xAxisColumn.', '.$startWeek.') AS catorder, sum('.$calculation.') counted'.$seriesSql)
                    ->where($xAxisColumn, '>=', Carbon::now()->startOfWeek()->subWeek($dataForLast))
                    ->groupBy('catorder', 'cat')
                    ->orderBy('catorder', 'asc');
            } else {
                $query = $model::selectRaw('DATE_FORMAT('.$xAxisColumn.', "%b %Y") AS cat, DATE_FORMAT('.$xAxisColumn.', "%Y-%m") AS catorder, sum('.$calculation.') counted'.$seriesSql)
                    ->where($xAxisColumn, '>=', Carbon::now()->firstOfMonth()->subMonth($dataForLast-1))
                    ->groupBy('catorder', 'cat')
                    ->orderBy('catorder', 'asc');
            }
            
            if(isset(json_decode($request->options, true)['queryFilter'])){
                $queryFilter = json_decode($request->options, true)['queryFilter'];
                foreach($queryFilter as $qF){
                    if(isset($qF['value'])){
                        if(isset($qF['operator'])){
                            $query->where($qF['key'], $qF['operator'], $qF['value']);
                        } else {
                            $query->where($qF['key'], $qF['value']);
                        }
                    } else {
                        if($qF['operator']=='IS NULL'){
                            $query->whereNull($qF['key']);
                        } else if($qF['operator']=='IS NOT NULL'){
                            $query->whereNotNull($qF['key']);
                        }
                    }
                }
            }
            $dataSet = $query->get();
            $xAxis = collect($dataSet)->map(function ($item, $key) use ($unitOfMeasurement){
                if($unitOfMeasurement=='week'){
                    $splitCat = str_split($item->only(['cat'])['cat'], 4);
                    $cat = "W".$splitCat[1]." ".$splitCat[0];
                } else {
                    $cat = $item->only(['cat'])['cat'];
                }
                return $cat;
            });
            if(isset($request->series)){
                $countKey = 0;
                foreach($request->series as $sKey => $sData){
                    $dataSeries = json_decode($sData);
                    $filter = $dataSeries->filter;
                    $yAxis[$sKey]['label'] = $dataSeries->label;
                    if(isset($dataSeries->fill)){
                        if($dataSeries->fill==false){
                            $yAxis[$sKey]['borderColor'] = $dataSeries->backgroundColor ?? $defaultColor[$sKey];
                            $yAxis[$sKey]['fill'] = false;
                        } else {
                            $yAxis[$sKey]['backgroundColor'] = $dataSeries->backgroundColor ?? $defaultColor[$sKey];
                        }
                    } else {
                        $yAxis[$sKey]['backgroundColor'] = $dataSeries->backgroundColor ?? $defaultColor[$sKey];
                    }
                    $yAxis[$sKey]['data'] = collect($dataSet)->map(function ($item, $key) use ($dataSeries){
                        return $item->only([$dataSeries->label])[$dataSeries->label];
                    });
                    $countKey++;
                }
                if($showTotal == true){
                    $yAxis[$countKey] = $this->counted($dataSet, $defaultColor[$countKey], 'line');
                }
            } else {
                $yAxis[0] = $this->counted($dataSet, $defaultColor[0]);
            }
            if ($request->input('expires')) {
                Cache::put($cacheKey, $dataSet, Carbon::parse($request->input('expires')));
            }
        }
        return response()->json(
            ['dataset' => [
                'xAxis'  => $xAxis,
                'yAxis'  => $yAxis
            ]
        ]);
    }
    
    private function counted($dataSet, $bgColor = "#111", $type = "bar")
    {
        $yAxis = [
            'type'  => $type,
            'label' => 'Total',
            'backgroundColor' => $bgColor,
            'data' => collect($dataSet)->map(function ($item, $key) {
                return $item->only(['counted'])['counted'];
            })
        ];
        return $yAxis;
    }
}