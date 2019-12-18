<?php

namespace Coroowicaksono\ChartJsIntegration;

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
            $defaultColor = array("#7cb5ec", "#434348", "#90ed7d", "#8085e9", "#f7a35c", "#f15c80", "#e4d354", "#2b908f", "#f45b5b", "#91e8e1", "#E27D60", "#85DCB", "#E8A87C", "#C38D9E", "#41B3A3", "#67c4a7", "#992667", "#ff4040", "#ff7373", "#d2d2d2");
            if(isset($request->series)){
                foreach($request->series as $seriesKey => $serieslist){
                    $seriesData = json_decode($serieslist);
                    $filter = $seriesData->filter;
                    $labelList[$seriesKey] = $seriesData->label;
                    $seriesSql .= ", SUM(CASE WHEN ".$filter->key." = '".$filter->value."' then 1 else 0 end) as '".$labelList[$seriesKey]."'";
                }
            }
            $dataSet = $model::selectRaw('DATE_FORMAT('.$xAxisColumn.', "%b %y") AS yearmonth, DATE_FORMAT('.$xAxisColumn.', "%y-%m") AS yearmonthorder, count(1) counted'.$seriesSql)
                ->where($xAxisColumn, '>=', Carbon::now()->firstOfMonth()->subMonth($dataForLast-1))
                ->groupBy('yearmonthorder', 'yearmonth')
                ->orderBy('yearmonthorder', 'asc')
                ->get();
            $xAxis = collect($dataSet)->map(function ($item, $key) {
                return $item->only(['yearmonth'])['yearmonth'];
            });
            if(isset($request->series)){
                $countKey = 0;
                foreach($request->series as $sKey => $sData){
                    $dataSeries = json_decode($sData);
                    $filter = $dataSeries->filter;
                    $yAxis[$sKey]['label'] = $dataSeries->label;
                    $yAxis[$sKey]['backgroundColor'] = $dataSeries->backgroundColor ?? $defaultColor[$sKey];
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