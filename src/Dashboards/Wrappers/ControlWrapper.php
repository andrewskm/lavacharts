<?php

namespace Andrewskm\Lavacharts\Dashboards\Wrappers;

use Andrewskm\Lavacharts\Values\ElementId;
use Andrewskm\Lavacharts\Dashboards\Filters\Filter;

/**
 * ControlWrapper Class
 *
 * Used for building controls for dashboards.
 *
 * @package   Andrewskm\Lavacharts\Dashboards\Wrappers
 * @since     3.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
class ControlWrapper extends Wrapper
{
    /**
     * Type of wrapper.
     *
     * @var string
     */
    const TYPE = 'ControlWrapper';

    /**
     * Builds a ControlWrapper object.
     *
     * @param  \Andrewskm\Lavacharts\Dashboards\Filters\Filter $filter
     * @param  \Andrewskm\Lavacharts\Values\ElementId          $containerId
     */
    public function __construct(Filter $filter, ElementId $containerId)
    {
        parent::__construct($filter, $containerId);
    }
}
