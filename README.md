# Getting Started

## Requirements

This Nova Chart JS Integration requires `Nova 2.0 or higher`

![Chart JS Integration in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/chart-js-integration.gif)

## Installation

You can install the package via composer:

```bash
composer require coroowicaksono/chart-js-integration
```

<!-- panels:start -->

<!-- div:title-panel -->

## Basic Usage

Open your `App\Providers\NovaServiceProvider.php` as a default dashboard for Laravel Nova and edit `cards` function:

<!-- div:left-panel -->


![code-chart-bar](assets/img/code-chart-bar.png)

Result :

![code-chart-bar](assets/img/chart-bar.png)

<!-- div:right-panel -->

```php
use Coroowicaksono\ChartJsIntegration\StackedChart;
```

```php
(new StackedChart())
    ->title('Revenue')
    ->series(array([
        'barPercentage' => 0.5,
        'label' => 'Product #1',
        'backgroundColor' => '#ffcc5c',
        'data' => [30, 70, 80],
    ],[
        'barPercentage' => 0.5,
        'label' => 'Product #2',
        'backgroundColor' => '#ff6f69',
        'data' => [40, 62, 79],
    ]))
    ->options([
        'xaxis' => [
            'categories' => [ 'Jan', 'Feb', 'Mar' ]       
        ],
    ])
    ->width('1/3'),
```

<!-- panels:end -->

# Custom Chart

## Stacked Chart

![StackedChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/screenshot-stacked-chart.png)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\StackedChart;
```

Add this line as return for your `cards` function:

```php
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
    ])
    ->width('2/3'),
```

## Bar Chart

![BarChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/screenshot-bar-chart.png)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\BarChart;
```

Add this line as return for your `cards` function:
```php
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
    ])
    ->width('2/3'),
```

## Line Chart

![LineChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/screenshot-line-chart.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\LineChart;
```

Add this line as return for your `cards` function:
```php
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
    ])
    ->width('2/3'),
```

## Area Chart

![AreaChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/screenshot-area-chart.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\AreaChart;
```

Add this line as return for your `cards` function:
```php
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
    ])
    ->width('2/3'),
```

## Doughnut Chart

![DoughnutChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/screenshot-doughnut-chart.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\DoughnutChart;
```

Add this line as return for your `cards` function:
```php
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
```

## Pie Chart

![PieChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/screenshot-pie-chart.jpg)

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\PieChart;
```

Add this line as return for your `cards` function:
```php
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
```

## Scatter Chart

![ScatterChart in Action](assets/img/scatter-chart.png)

> This scatter chart for now only available in custom data. 
> For using model, please use another chart.

Include this line to header in your NovaServiceProvider.php
```php
use Coroowicaksono\ChartJsIntegration\ScatterChart;
```

Scatter charts are based on basic line charts with the x axis changed to a linear axis. To use a scatter chart, data must be passed as objects containing X and Y properties. The example below creates random data for scatter chart with 2 label.
```php
    $dataChart1 = [];
    $dataChart2 = [];
    for($i=0; $i<=50; $i++){
        $dataChart1[$i] = [
            'x' => rand(-25,25),
            'y' => rand(-25,25),
        ];
        $dataChart2[$i] = [
            'x' => rand(-25,25),
            'y' => rand(-25,25),
        ];
    }

    return [
        (new ScatterChart())
            ->title('Revenue')
            ->series(array([
                'label' => 'Scatter #1',
                'backgroundColor' => '#ffcc5c',
                'data' => $dataChart1
            ],[
                'label' => 'Scatter #2',
                'backgroundColor' => '#90ed7d',
                'data' => $dataChart2
            ]))
            ->width('2/3')
    ];
```

Unlike previous another chart where xaxis suplied inside `options`, the scatter chart only accepts data in format x and y inside `series`->`data`. This is the simple data structure looks like:
```php
    ->series(
        array([
            'label' => 'Scatter #3',
            'backgroundColor' => '#b088d8',
            'data' => array([
                'x' => -8,
                'y' => 3,
            ],[
                'x' => 7,
                'y' => 28,
            ])
        ])
    )
```

# Basic Configuration

The configuration is used to change how the chart behaves. There are properties to control styling, fonts, the legend, etc.

## Hide Total

![BarChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/hide-show-total.jpg)

By default, `nova-chartjs` will showing your Total Calculation in chart. For hide total column in your Chart, please use this option:
```php
->options([
    'showTotal' => false
])
```

So your card should be like:
```php
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
    ->width('2/3'),
```

## Legend

![Legend in Action](assets/img/legend.png)

### Hide Legend {docsify-ignore}

By default, `nova-chartjs` will showing legend in chart. For hide legend in your Chart, please use this option:
```php
->options([
    'legend' => [
        'display' => false
    ]
])
```

So your card should be like:
```php
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
        'legend' => [
            'display' => false // Hide Legend
        ]
    ])
    ->width('2/3'),
```

### Set Legend {docsify-ignore}

![Left Legend in Action](assets/img/left-legend.png)

For set position of legend in your Chart, please use this option:
```php
->options([
    'legend' => [
        'display' => true,
        'position' => 'left',
    ]
])
```

So your card should be like:
```php
(new PieChart())
    ->title('Revenue')
    ->series(array([
        'data' => [10, 10, 10, 10, 10, 10, 10, 10],
        'backgroundColor' => ["#ffcc5c","#91e8e1","#ff6f69","#88d8b0","#b088d8","#d8b088", "#88b0d8", "#6f69ff"],
    ]))
    ->options([
        'legend' => [
            'display' => true,
            'position' => 'left'
        ],
        'xaxis' => [
            'categories' => ['Portion 1','Portion 2','Portion 3','Portion 4','Portion 5','Portion 6','Portion 7','Portion 8']
        ],
    ])->width('1/3'),
```

## Layout

![Layout Configuration in Action](assets/img/layout-configuration.png)

In layout configuration, you can add padding for chart. <br/>More documentation related `layout` also can be found at https://www.chartjs.org/docs/latest/configuration/layout.html
```php
->options([
    'layout' => [
        'padding' => [
            'left' => 50,
            'right' => 50,
            'top' => 50,
            'bottom' => 50
        ],
    ],
])
```

So your card should be like:
```php
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
        'layout' => [
            'padding' => [
                'left' => 50,
                'right' => 50,
                'top' => 50,
                'bottom' => 50
            ],
        ],
        'xaxis' => [
            'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
        ],
    ])
    ->width('2/3'),
```

## Refresh Button

![Refresh Button](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/refresh-button.jpg)

To add refresh button for refresh the chart, please use this `btnRefresh` in your `options`:
```php
->options([
    'btnRefresh' => true // default is false
])
```

So your card should be like:
```php
(new StackedChart())
    ->title('Revenue')
    ->model('\App\Models\Sales') // Use Your Model Here
    ->options([
        'btnRefresh' => true
    ])
    ->width('2/3'),
```

## Custom Background Color

By default, we already define the color for Chart. But you can easily change the hex code by adding this line to your series:
```php
'backgroundColor' => '#F87900',
```

So your card should be like:
```php
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
    ->width('2/3'),
```

# Use Laravel Model

We use `created_at` to define the month and year name in categories. So make sure your data consist of this column.

## Simple Chart With Data

![Simple Chart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/simple-with-data.jpg)

> This action available for BarChart, StackedChart, LineChart and StackedChart. 
> For another chart, please use [Custom Column Calculation](#custom-column-calculation)

Add this line to your cards function:
```php
(new StackedChart())
    ->title('Revenue')
    ->model('\App\Models\Sales') // Use Your Model Here
    ->width('2/3'),
```

## Custom Column Calculation

![Custom Column Calculation in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/stacked-chart-with-data.jpg)

> This action available for BarChart, StackedChart, LineChart, StackedChart, Doughnut Chart and Pie Chart.

Add this line to your cards function:
```php
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
    ->width('2/3'),
```

## Extend Custom Condition

For extend custom condition / filter, e.g. `WHERE` for column in your data, please use this `queryFilter` in `options`:
```php
->options([
    'queryFilter' => array([
        'key' => 'status',
        'operator' => '=',
        'value' => 'success'
    ],[
        'key' => 'updated_at',
        'operator' => 'IS NOT NULL',
    ])
])
```

So your card should be like:
```php
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
        ])
    ])
    ->width('2/3'),
```

## Latest Data to Show

> By Default, if you using chart with data, the chart <b>will only show your 3 latest month</b>. <br/>If you want to extend it, please refer to below documentation:

### Show All Data

By Default, if you using chart with data, the chart will only show your 3 latest month. If you want to change count of month that you need to show, use:
```php
->options([
    'latestData' => '*' // show all data
])
```

So your card should be like:
```php
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
        'latestData' => '*'
    ])
    ->width('2/3'),
```

### Latest Monthly Data

![BarChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/latest-data.jpg)

By Default, if you using chart with data, the chart will only show your 3 latest month. If you want to change count of month that you need to show, use:
```php
->options([
    'latestData' => 6 // in months
])
```

So your card should be like:
```php
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
    ->width('2/3'),
```

### Latest Weekly Data

![BarChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/weekly-view.jpg)

By Default, if you using chart with data, the chart will only show your 3 latest month. If you want to use weekly base view, please use:
```php
->options([
    'uom' => 'week', // available in 'day', 'week', 'month'
])
``` 

### Set Up Weekly View {docsify-ignore}
```php
->options([
    'uom' => 'week',
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
        'uom' => 'week' // available in 'day', 'week', 'month'
    ])
    ->width('2/3'),
```

### Latest Daily Data

![BarChart in Action](https://raw.githubusercontent.com/coroo/nova-chartjs/gh-pages/assets/img/daily-view.jpg)

For daily base view, please use:
```php
->options([
    'uom' => 'day', // available in 'day', 'week', 'month'
])
``` 

So your card should be like:
```php
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
        'uom' => 'day' // available in 'day', 'week', 'month'
    ])
    ->width('2/3'),
```

## Sum Calculation

By default, nova-chart-js will show count of your data.
If you need to do sum calculation, please use this `sum` in your `options` with the value is your field:
```php
->options([
    'sum' => 'my_sales_column'
])
```

So your card should be like:
```php
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
    ->width('2/3'),
```

## Join Table

For join table, you need to add join query builder after call your model:
```php
->join('sales as salesData', 'users.id', '=', 'salesData.user_id')
```

Then you can call your column instead:
```php
->series(array([
    'label' => 'Product A',
    'filter' => [
        'key' => 'salesData.product_id', // State Column for Count Calculation Here
        'value' => '1'
    ],
]))
```

So your card should be like:
```php
(new StackedChart())
    ->title('Revenue')
    ->model('\App\Models\Users') // Use Your Model Here
    ->join('user_profiles as policyHolderDetail', 'user_policies.policy_holder_id', '=', 'policyHolderDetail.user_id')
    ->series(array([
        'label' => 'Product A',
        'filter' => [
            'key' => 'salesData.product_id', // State Column for Count Calculation Here
            'value' => '1'
        ],
    ],[
        'label' => 'Product B',
        'filter' => [
            'key' => 'salesData.product_id', // State Column for Count Calculation Here
            'value' => '2'
        ],
    ],[
        'label' => 'Product C',
        'filter' => [
            'key' => 'salesData.product_id', // State Column for Count Calculation Here
            'value' => '3'
        ],
    ]))
    ->width('2/3'),
```

# More Reference 

[ChartJS Documentation](https://www.chartjs.org/docs/latest/)
| [Vue-ChartJS Documentation](https://vue-chartjs.org/guide/)

# Issue 

For any issue, we capture it in [HERE](https://github.com/coroo/nova-chartjs/issues).

# ChangeLog

Please see [CHANGELOG](https://github.com/coroo/nova-chartjs/blob/master/CHANGELOG.md) for more information on what has changed recently.

# Suport Us

<a href="https://www.buymeacoffee.com/coroowicaksono" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-red.png" alt="Buy Us A Coffee" style="margin-right:20px; height: 51px !important;width: 217px !important;" ></a> Or rate us <a href="https://github.com/coroo/nova-chartjs/stargazers"><img src="https://img.shields.io/github/stars/coroo/nova-chartjs?style=social" style="margin-left:10px;box-shadow:none;border-radius:0;height:24px"></a>

## Backers

<a href="https://github.com/gmill20" target="_blank"><img src="https://avatars3.githubusercontent.com/u/11597797?s=400&v=4" alt="gmill20" style="width:50px"></a>

<a href="https://www.buymeacoffee.com/coroowicaksono" target="_blank">Became a backers</a>


# Contribute

Be one of our contributor at [contributor](https://github.com/coroo/nova-chartjs/blob/master/CONTRIBUTING.md).

# License

The MIT License (MIT). Please see [License File](https://github.com/coroo/nova-chartjs/blob/master/LICENSE) for more information.

# Another Related Products 

| Nova Carousel | Awesome ChartJS |
|:---:|:---:|
| <a href="https://coroo.github.io/nova-carousel/"><img height="200" src="https://github.com/coroo/nova-carousel/blob/gh-pages/assets/img/nova-carousel-cover.gif?raw=true"></a> | <a href="https://github.com/chartjs/awesome#others"><img height="200" src="https://camo.githubusercontent.com/f9cd5c942fce5f8d2110e147663b0a5fd27f3e1e/68747470733a2f2f7777772e63686172746a732e6f72672f6d656469612f617765736f6d652e737667"></a> |