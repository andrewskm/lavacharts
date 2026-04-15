<?php

namespace Andrewskm\Lavacharts\Support\Contracts;

use \Andrewskm\Lavacharts\Values\Label;
use \Andrewskm\Lavacharts\Values\ElementId;

/**
 * Interface RenderableInterface
 *
 * Defining the methods a class must have to be Renderable.
 *
 * @package    Andrewskm\Lavacharts\Support
 * @since      3.1.0
 * @author     Kevin Hill <kevinkhill@gmail.com>
 * @copyright  (c) 2017, KHill Designs
 * @link       http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link       http://lavacharts.com                   Official Docs Site
 * @license    http://opensource.org/licenses/MIT MIT
 */
interface RenderableInterface
{
    /**
     * Creates and/or sets the Label.
     *
     * @param  string|\Andrewskm\Lavacharts\Values\Label $label
     * @throws \Andrewskm\Lavacharts\Exceptions\InvalidLabel
     */
    public function setLabel($label);

    /**
     * Returns the label.
     *
     * @return \Andrewskm\Lavacharts\Values\Label
     */
    public function getLabel();

    /**
     * Returns the label.
     *
     * @return \Andrewskm\Lavacharts\Values\Label
     */
    public function getLabelStr();
}
