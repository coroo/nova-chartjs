<?php

namespace Coroowicaksono\ChartJsIntegration;

use Laravel\Nova\Card;
use Laravel\Nova\Metrics\Metric;

class DoughnutChart extends Metric
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    public function __construct($component = null)
    {

        parent::__construct($component);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'doughnut-chart';
    }

    public function series(array $series): self
    {
        return $this->withMeta(['series' => $series]);
    }

    public function type(string $type): self
    {
        return $this->withMeta(['type' => $type]);
    }

    public function options(array $options): self
    {
        return $this->withMeta(['options' => (object) $options]);
    }

    public function animations(array $animations): self
    {
        return $this->withMeta(['animations' => $animations]);
    }

    public function title(string $title): self
    {
        return $this->withMeta(['title' => $title]);
    }

    public function model(string $model): self
    {
        return $this->withMeta(['model' => $model]);
    }

    public function col_xaxis(string $col_xaxis): self
    {
        return $this->withMeta(['col_xaxis' => $col_xaxis]);
    }

    public function join(string $joinTable, string $joinColumnFirst, string $joinEqual, string $joinColumnSecond): self
    {
        return $this->withMeta(['join' => ['joinTable' => $joinTable, 'joinColumnFirst' => $joinColumnFirst, 'joinEqual' => $joinEqual, 'joinColumnSecond' => $joinColumnSecond]]);
    }
}
