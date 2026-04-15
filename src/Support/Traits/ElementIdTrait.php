<?php

namespace Andrewskm\Lavacharts\Support\Traits;

use Andrewskm\Lavacharts\Values\ElementId;

/**
 * Trait ElementIdTrait
 *
 * Trait for adding the methods for getting/setting the html id of a div tag,
 * that a Renderable can be output into.
 *
 * @package   Andrewskm\Lavacharts\Support\Traits
 * @since     3.1.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
trait ElementIdTrait
{
    /**
     * Creates and/or sets the ElementId.
     *
     * @param  string|\Andrewskm\Lavacharts\Values\ElementId $elementId
     * @throws \Andrewskm\Lavacharts\Exceptions\InvalidElementId
     */
    public function setElementId($elementId)
    {
        if ($elementId instanceof ElementId) {
            $this->elementId = $elementId;
        } else {
            $this->elementId = new ElementId($elementId);
        }
    }

    /**
     * Check to see if the class has it's elementId set.
     *
     * @since  3.1.0
     * @return bool
     */
    public function hasElementId()
    {
        return isset($this->elementId);
    }

    /**
     * Returns the ElementId.
     *
     * @return \Andrewskm\Lavacharts\Values\ElementId
     */
    public function getElementId()
    {
        return $this->elementId;
    }

    /**
     * Returns the ElementId as a string.
     *
     * @return string
     */
    public function getElementIdStr()
    {
        return (string) $this->elementId;
    }
}
