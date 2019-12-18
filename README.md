<p align="center">
  <img src="https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/header.png">
  <hr/>
</p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coroowicaksono/chart-js-integration)](https://packagist.org/packages/coroowicaksono/chart-js-integration)
[![Total Downloads](https://img.shields.io/packagist/dt/coroowicaksono/chart-js-integration)](https://packagist.org/packages/coroowicaksono/chart-js-integration)
[![License](https://img.shields.io/packagist/l/coroowicaksono/chart-js-integration)](https://github.com/coroo/chart-js-integration/blob/master/LICENSE)

A Simple Dashboard Laravel Nova using Chart JS. 

[ChartJS Documentation](https://www.chartjs.org/docs/latest/)
| [Vue-ChartJS Documentation](https://vue-chartjs.org/guide/)

## Requirements

This Nova Chart JS Integration requires Nova 2.0 or higher.

![Chart JS Integration in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/chart-js-integration.gif)

# Installation

You can install the package via composer:

```bash
composer require coroowicaksono/chart-js-integration
```

# In this tutorial
- [Use Custom Data](#use-custom-data)
    - [Stacked Chart](#stacked-chart)
    - [Bar Chart](#bar-chart)
- [Use Data From Model](#use-model)
    - [Simple Chart with Data](#simple-chart-with-data)
    - [Custom Column Calculation](#custom-column-calculation)
    - [Show Latest XX Month](#latest-month)
    - [Custom Background Color](#custom-background-color)
    - [Hide Total](#hide-total)

# Use Custom Data

## Stacked Chart

![StackedChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/screenshot-stacked-chart.png)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\StackedChart;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new StackedChart())
            ->title('Revenue')
            ->animations([
                'enabled' => true,
                'easing' => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.5,
                'label' => 'Average Sales',
                'backgroundColor' => '#999',
                'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
            ],[
                'barPercentage' => 0.5,
                'label' => 'Average Sales 2',
                'backgroundColor' => '#F87900',
                'data' => [40, 62, 79, 80, 90, 79, 90, 90, 90, 92, 91, 80],
            ]))
            ->options([
                'xaxis' => [
                    'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
                ],
            ])->width('2/3')
        ];
    }

}
```

## Bar Chart

![BarChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/screenshot-bar-chart.png)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\BarChart;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new BarChart())
            ->title('Revenue')
            ->animations([
                'enabled' => true,
                'easing' => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.5,
                'label' => 'Average Sales',
                'backgroundColor' => '#999',
                'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
            ],[
                'barPercentage' => 0.5,
                'label' => 'Average Sales 2',
                'backgroundColor' => '#F87900',
                'data' => [40, 62, 79, 80, 90, 79, 90, 90, 90, 92, 91, 80],
            ]))
            ->options([
                'xaxis' => [
                    'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
                ],
            ])->width('2/3')
        ];
    }

}
```

# Use Model

We use `created_at` to define the month and year name in categories. So make sure your data consist of this column.

## Simple Chart With Data

![Simple Chart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/simple-with-data.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\StackedChart;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new StackedChart())
            ->title('Revenue')
            ->model('\App\Models\Sales') // Use Your Model Here
            ->width('2/3')
        ];
    }

}
```

## Custom Column Calculation

![Custom Column Calculation in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/stacked-chart-with-data.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\StackedChart;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new StackedChart())
            ->title('Revenue')
            ->model('\App\Models\Sales') // Use Your Model Here
            ->series(array([
                'label' => 'Product A',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '1'
                ],
            ],[
                'label' => 'Product B',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '2'
                ],
            ],[
                'label' => 'Product C',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '3'
                ],
            ]))
            ->width('2/3')
        ];
    }

}
```

## Latest Month

![BarChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/latest-data.jpg)

By Default, if you using chart with data, the chart will only show your 3 latest month. If you want to change count of month that you need to show, use:
```php
->options([
    'latestData' => 6 // in months
])
```

So your card should be like:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new StackedChart())
            ->title('Revenue')
            ->model('\App\Models\Sales') // Use Your Model Here
            ->series(array([
                'label' => 'Product A',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '1'
                ],
            ],[
                'label' => 'Product B',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '2'
                ],
            ],[
                'label' => 'Product C',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '3'
                ],
            ]))
            ->options([
                'latestData' => 6 // Show last 6 months data
            ])
            ->width('2/3')
        ];
    }

}
```

## Custom Background Color

By default, we already define the color for Chart. But you can easily change the hex code by adding this line to your series:
```php
    'backgroundColor' => '#F87900',
```

So your card should be like:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new StackedChart())
            ->title('Revenue')
            ->model('\App\Models\Sales') // Use Your Model Here
            ->series(array([
                'label' => 'Product A',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '1'
                ],
                'backgroundColor' => '#F87900', // Add This to change the background color
            ],[
                'label' => 'Product B',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '2'
                ],
            ],[
                'label' => 'Product C',
                'filter' => [
                    'key' => 'product_id', // State Column for Count Calculation Here
                    'value' => '3'
                ],
            ]))
            ->options([
                'showTotal' => false // Hide Show Total in Your Chart
            ])
            ->width('2/3')
        ];
    }

}
```

## License

The MIT License (MIT). Please see [License File](https://github.com/coroo/chart-js-integration/blob/master/LICENSE) for more information.


