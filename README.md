# Lavacharts 3.x

## Package Features
- **Updated!** Laravel 5.5+ auto-discovery
- Any option for customizing charts that Google supports, Lavacharts should as well. Just use the chart constructor to assign any customization options you wish!
 - Visit [Google's Chart Gallery](https://developers.google.com/chart/interactive/docs/gallery) for details on available options
- Custom JavaScript module for interacting with charts client-side
  - AJAX data reloading
  - Fetching charts
  - Events integration
- Column Formatters & Roles
- Blade template extensions for Laravel
- Twig template extensions for Symfony
- [Carbon](https://github.com/briannesbitt/Carbon) support for date/datetime/timeofday columns
- Now supporting **22** Charts!
  - Annotation, Area, Bar, Bubble, Calendar, Candlestick, Column, Combo, Gantt, Gauge, Geo, Histogram, Line, Org, Pie, Sankey, Scatter, SteppedArea, Table, Timeline, TreeMap, and WordTree!


### For complete documentation, please visit [lavacharts.com](http://lavacharts.com/)

#### Upgrade guide: [Migrating from 2.5.x to 3.0.x](https://github.com/kevinkhill/lavacharts/wiki/Upgrading-from-2.5-to-3.0)
#### For contributing, a handy guide [can be found here](https://github.com/kevinkhill/lavacharts/blob/master/.github/CONTRIBUTING.md)

---

## Installing
In your project's main `composer.json` file, add this line to the requirements:
```
"andrewskm/lavacharts": "^3.2"
```

Run Composer to install Lavacharts:
```bash
$ composer update
```

## Framework Agnostic
If you are using Lavacharts with Silex, Lumen or your own Composer project, that's no problem! Just make sure to:
`require 'vendor/autoload.php';` within you project and create an instance of Lavacharts: `$lava = new Andrewskm\Lavacharts\Lavacharts;`


## Laravel
To integrate Lavacharts into Laravel, a ServiceProvider has been included.

#### Configuration
To modify the default configuration of Lavacharts, datetime formats for datatables or adding your maps api key...
Publish the configuration with `php artisan vendor:publish --tag=lavacharts`

### Laravel ~5.4
Register Lavacharts in your app by adding these lines to the respective arrays found in `config/app.php`:
```php
<?php
// config/app.php

// ...
'providers' => [
    // ...

    Andrewskm\Lavacharts\Laravel\LavachartsServiceProvider::class,
],

// ...
'aliases' => [
    // ...

    'Lava' => Andrewskm\Lavacharts\Laravel\LavachartsFacade::class,
]
```
#### Configuration
To modify the default configuration of Lavacharts, datetime formats for datatables or adding your maps api key...
Publish the configuration with `php artisan vendor:publish --tag=lavacharts`

#### Configuration
To modify the default configuration of Lavacharts, datetime formats for datatables or adding your maps api key...
Publish the configuration with `php artisan config:publish khill/lavacharts`

# Usage
The creation of charts is separated into two parts:
First, within a route or controller, you define the chart, the data table, and the customization of the output.

Second, within a view, you use one line and the library will output all the necessary JavaScript code for you.

## Basic Example
Here is an example of the simplest chart you can create: A line chart with one dataset and a title, no configuration.

### Controller
Setting up your first chart.

#### Data
```php
$data = $lava->DataTable();

$data->addDateColumn('Day of Month')
     ->addNumberColumn('Projected')
     ->addNumberColumn('Official');

// Random Data For Example
for ($a = 1; $a < 30; $a++) {
    $rowData = [
      "2017-4-$a", rand(800,1000), rand(800,1000)
    ];

    $data->addRow($rowData);
}
```

Arrays work for datatables as well...
```php
$data->addColumns([
    ['date', 'Day of Month'],
    ['number', 'Projected'],
    ['number', 'Official']
]);
```

Or you can `use \Andrewskm\Lavacharts\DataTables\DataFactory` [to create DataTables in another way](https://gist.github.com/kevinkhill/0c7c5f6211c7fd8f9658)

#### Chart Options
Customize your chart, with any options found in Google's documentation. Break objects down into arrays and pass to the chart.
```php
$lava->LineChart('Stocks', $data, [
    'title' => 'Stock Market Trends',
    'animation' => [
        'startup' => true,
        'easing' => 'inAndOut'
    ],
    'colors' => ['blue', '#F4C1D8']
]);
```

#### Output ID
The chart will needs to be output into a div on the page, so an html ID for a div is needed.
Here is where you want your chart `<div id="stocks-div"></div>`
 - If no options for the chart are set, then the third parameter is the id of the output:
```php
$lava->LineChart('Stocks', $data, 'stocks-div');
```
 - If there are options set for the chart, then the id may be included in the options:
```php
$lava->LineChart('Stocks', $data, [
    'elementId' => 'stocks-div'
    'title' => 'Stock Market Trends'
]);
```
 - The 4th parameter will also work:
```php
$lava->LineChart('Stocks', $data, [
    'title' => 'Stock Market Trends'
], 'stocks-div');
```


## View
Pass the main Lavacharts instance to the view, because all of the defined charts are stored within, and render!
```php
<?= $lava->render('LineChart', 'Stocks', 'stocks-div'); ?>
```

Or if you have multiple charts, you can condense theh view code withL
```php
<?= $lava->renderAll(); ?>
```
