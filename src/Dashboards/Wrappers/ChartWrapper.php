<?php

namespace Andrewskm\Lavacharts\Dashboards\Wrappers;

use Andrewskm\Lavacharts\Charts\Chart;
use Andrewskm\Lavacharts\Values\ElementId;

/**
 * Class ChartWrapper
 *
 * Used for wrapping charts to use in dashboards.
 *
 * @package   Andrewskm\Lavacharts\Dashboards\Wrappers
 * @since     3.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
class ChartWrapper extends Wrapper
{
    /**
     * Type of wrapper.
     *
     * @var string
     */
    const TYPE = 'ChartWrapper';

    /**
     * Builds a ChartWrapper object.
     *
     * @param  \Andrewskm\Lavacharts\Charts\Chart     $chart
     * @param  \Andrewskm\Lavacharts\Values\ElementId $containerId
     */
    public function __construct(Chart $chart, ElementId $containerId)
    {
        $chart->setRenderable(false);

        parent::__construct($chart, $containerId);
    }
}
