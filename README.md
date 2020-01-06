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
    - [Line Chart](#line-chart)
    - [Area Chart](#area-chart)
    - [Doughnut Chart](#doughnut-chart)
    - [Pie Chart](#pie-chart)
- [Use Data From Model](#use-model)
    - [Simple Chart with Data](#simple-chart-with-data)
    - [Custom Column Calculation](#custom-column-calculation)
    - [Show Latest XX Month](#latest-month)
    - [Use Weekly Base View](#use-weekly-view)
        - [Set Up Weekly View](#set-up-weekly-view)
    - [Custom Background Color](#custom-background-color)
    - [Hide Total](#hide-total)
    - [Adding Filter](#adding-filter)
    - [Sum Calculation](#sum-calculation)

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

## Line Chart

![LineChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/screenshot-line-chart.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\LineChart;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new LineChart())
            ->title('Revenue')
            ->animations([
                'enabled' => true,
                'easing' => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.5,
                'label' => 'Average Sales',
                'borderColor' => '#f7a35c',
                'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
            ],[
                'barPercentage' => 0.5,
                'label' => 'Average Sales #2',
                'borderColor' => '#90ed7d',
                'data' => [90, 80, 40, 22, 79, 129, 30, 40, 90, 92, 91, 80],
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

## Area Chart

![AreaChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/screenshot-area-chart.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\AreaChart;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new AreaChart())
            ->title('Revenue')
            ->animations([
                'enabled' => true,
                'easing' => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.5,
                'label' => 'Average Sales',
                'backgroundColor' => '#f7a35c',
                'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
            ],[
                'barPercentage' => 0.5,
                'label' => 'Average Sales #2',
                'backgroundColor' => '#90ed7d',
                'data' => [90, 80, 40, 22, 79, 129, 30, 40, 90, 92, 91, 80],
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

## Doughnut Chart

![DoughnutChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/screenshot-doughnut-chart.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\DoughnutChart;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new DoughnutChart())
            ->title('Revenue')
            ->series(array([
                'data' => [10, 10, 10, 10, 10, 10, 10, 10],
                'backgroundColor' => ["#ffcc5c","#91e8e1","#ff6f69","#88d8b0","#b088d8","#d8b088", "#88b0d8", "#6f69ff"],
            ]))
            ->options([
                'xaxis' => [
                    'categories' => ['Portion 1','Portion 2','Portion 3','Portion 4','Portion 5','Portion 6','Portion 7','Portion 8']
                ],
            ])->width('1/3'),
        ];
    }

}
```

## Pie Chart

![PieChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/screenshot-pie-chart.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\PieChart;
```

Add this line to your cards function:
```php
class NovaServiceProvider extends NovaApplicationServiceProvider
{

    public function cards(Request $request)
    {
        return [
            (new PieChart())
            ->title('Revenue')
            ->series(array([
                'data' => [10, 20, 10, 10, 10, 10, 10, 10],
                'backgroundColor' => ["#ffcc5c","#91e8e1","#ff6f69","#88d8b0","#b088d8","#d8b088", "#88b0d8", "#6f69ff"],
            ]))
            ->options([
                'xaxis' => [
                    'categories' => ['Portion 1','Portion 2','Portion 3','Portion 4','Portion 5','Portion 6','Portion 7','Portion 8']
                ],
            ])->width('1/3'),
        ];
    }

}
```

# Use Model

We use `created_at` to define the month and year name in categories. So make sure your data consist of this column.

## Simple Chart With Data

![Simple Chart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/simple-with-data.jpg)

> This action available for BarChart, StackedChart, LineChart and StackedChart. 
> For another chart, please use [Custom Column Calculation](#custom-column-calculation)

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

> This action available for BarChart, StackedChart, LineChart, StackedChart, Doughnut Chart and Pie Chart.

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

## Use Weekly View

![BarChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/weekly-view.jpg)

By Default, if you using chart with data, the chart will only show your 3 latest month. If you want to use weekly base view, please use:
```php
->options([
    'uom' => 'week', // available in 'week', 'month'
])
``` 

### Set Up Weekly View
```php
->options([
    'startWeek' => '0', // (optional) by Default, starweek start from 0
    // startWeek 0 - First day of week is Sunday
    // startWeek 1 - First day of week is Monday and the first week has more than 3 days
    // startWeek 2 - First day of week is Sunday
    // startWeek 3 - First day of week is Monday and the first week has more than 3 days
    // startWeek 4 - First day of week is Sunday and the first week has more than 3 days
    // startWeek 5 - First day of week is Monday
    // startWeek 6 - First day of week is Sunday and the first week has more than 3 days
    // startWeek 7 - First day of week is Monday
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
                'latestData' => 6, // Show last 6 weeks data (optional)
                'uom' => 'week' // available in 'week', 'month'
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

## Hide Total

![BarChart in Action](https://raw.githubusercontent.com/coroo/chart-js-integration/master/resources/img/hide-show-total.jpg)

For hide total column in your Chart, please use this option:
```php
->options([
    'showTotal' => false
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
                'showTotal' => false // Hide Show Total in Your Chart
            ])
            ->width('2/3')
        ];
    }

}
```

## Adding Filter

For adding filter column in your data, please use this `queryFilter` in `options`:
```php
->options([
    'queryFilter' => array([
        'key' => 'status',
        'operator' => '=',
        'value' => 'success'
    ],[
        'key' => 'updated_at',
        'operator' => 'IS NOT NULL',
    ]
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
                'queryFilter' => array([    // add array of filter with this format
                    'key' => 'status',
                    'operator' => '=',
                    'value' => 'success'
                ],[
                    'key' => 'updated_at',
                    'operator' => 'IS NOT NULL',
                ]
            ])
            ->width('2/3')
        ];
    }

}
```

## Sum Calculation

By default, chart-js-integration will show count of your data.
If you need to do sum calculation, please use this `sum` in your `options` with the value is your field:
```php
->options([
    'sum' => 'my_sales_column'
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
                'sum' => 'my_sales_column' // Add the column you want to calculate
            ])
            ->width('2/3')
        ];
    }

}
```

## ChangeLog

Please see [CHANGELOG](https://github.com/coroo/chart-js-integration/blob/master/CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](https://github.com/coroo/chart-js-integration/blob/master/LICENSE) for more information.


