<?php

namespace Coroowicaksono\ChartJsIntegration;

use Laravel\Nova\Card;

class PieChart extends Card
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
        return 'pie-chart';
    }

    public function series(array $series): self
    {
        return $this->withMeta([ 'series' => $series ]);
    }

    public function type(string $type): self
    {
        return $this->withMeta([ 'type' => $type ]);
    }

    public function options(array $options): self
    {
        return $this->withMeta([ 'options' => (object) $options ]);
    }

    public function animations(array $animations): self
    {
        return $this->withMeta([ 'animations' => $animations ]);
    }

    public function title(string $title): self
    {
        return $this->withMeta([ 'title' => $title ]);
    }

    public function model(string $model): self
    {
        return $this->withMeta([ 'model' => $model ]);
    }
}
