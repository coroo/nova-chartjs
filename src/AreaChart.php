<?php

namespace Coroowicaksono\ChartJsIntegration;

use Laravel\Nova\Card;

class AreaChart extends Card
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
        return 'stripe-chart';
    }

    public function series(array $series): self
    {
        foreach($series as $key => $data){
            if(isset($data['backgroundColor'])){
                $series[$key]['borderColor'] = $this->adjustBrightness($data['backgroundColor'], '-40');
            }
        }
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

    private function adjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));
    
        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }
    
        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';
    
        foreach ($color_parts as $color) {
            $color   = hexdec($color); // Convert to decimal
            $color   = max(0,min(255,$color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }
    
        return $return;
    }
}
