<p align="center">
  <img src="https://raw.githubusercontent.com/coroo/chart-js-integration/master/src/img/header.png">
  <hr/>
</p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coroowicaksono/chart-js-integration)](https://packagist.org/packages/coroowicaksono/chart-js-integration)
[![Total Downloads](https://img.shields.io/packagist/dt/coroowicaksono/chart-js-integration)](https://packagist.org/packages/coroowicaksono/chart-js-integration)
[![License](https://img.shields.io/packagist/l/coroowicaksono/chart-js-integration)](https://github.com/coroo/chart-js-integration/blob/master/LICENSE)

A Simple Laravel Nova with Chart JS Integration Package. 

[ChartJS Documentation](https://www.chartjs.org/docs/latest/)
| [Vue-ChartJS Documentation](https://vue-chartjs.org/guide/)

## Requirements

This Nova Chart JS Integration requires Nova 2.0 or higher.

# Installation

You can install the package via composer:

```bash
composer require coroo/chart-js-integration
```

## Basic Usage

Include this line to header in your NovaServiceProvider.php
```php
use Coroo\ChartJsIntegration\ChartJsIntegration;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
        {
    
            return [
                (new ChartJsIntegration())
                    ->type('bar')
                    ->title('Revenue')
                    ->animations([
                        'enabled' => true,
                        'easing' => 'easeinout',
                    ])
                    ->series(array([
                        'type' => 'bar',
                        'barPercentage' => 0.5,
                        'label' => 'Average Sales',
                        'backgroundColor' => '#999',
                        'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
                    ],[
                        'type' => 'bar',
                        'barPercentage' => 0.5,
                        'label' => 'Average Sales 2',
                        'backgroundColor' => '#F87900',
                        'data' => [40, 62, 79, 80, 90, 79, 90, 90, 90, 92, 91, 80],
                    ]))
                    ->options([
                        'stacked' => true,
                        'xaxis' => [
                            'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
                        ],
                    ])->width('2/3')
            ];
        }

}
```

## Stacked Chart

![SliderFilter in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/src/img/screenshot.png)

## License

The MIT License (MIT). Please see [License File](https://github.com/coroo/chart-js-integration/blob/master/LICENSE) for more information.


