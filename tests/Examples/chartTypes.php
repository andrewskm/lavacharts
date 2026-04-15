<?php

require('vendor/autoload.php');

use \Andrewskm\Lavacharts\Charts\ChartFactory;

echo json_encode(ChartFactory::$CHART_TYPES);
