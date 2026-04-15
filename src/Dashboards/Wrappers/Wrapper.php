<?php

namespace Andrewskm\Lavacharts\Dashboards\Wrappers;

use Andrewskm\Lavacharts\Values\ElementId;
use Andrewskm\Lavacharts\Support\Traits\ElementIdTrait as HasElementId;
use Andrewskm\Lavacharts\Support\Contracts\WrappableInterface as Wrappable;
use Andrewskm\Lavacharts\Support\Contracts\JsonableInterface as Jsonable;
use Andrewskm\Lavacharts\Support\Contracts\JsClassInterface as JsClass;

/**
 * Class Wrapper
 *
 * The control and chart wrappers extend this for common methods.
 *
 *
 * @package   Andrewskm\Lavacharts\Dashboards\Wrappers
 * @since     3.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
class Wrapper extends Customizable implements \JsonSerializable, Jsonable, JsClass
{
    use HasElementId;

    /**
     * The contents of the wrap, either Chart or Filter.
     *
     * @var \Andrewskm\Lavacharts\Support\Contracts\WrappableInterface
     */
    protected $contents;

    /**
     * The renderable's unique elementId.
     *
     * @var \Andrewskm\Lavacharts\Values\ElementId
     */
    protected $elementId;

    /**
     * Builds a new Wrapper object.
     *
     * @param \Andrewskm\Lavacharts\Support\Contracts\WrappableInterface $itemToWrap
     * @param \Andrewskm\Lavacharts\Values\ElementId                     $elementId
     */
    public function __construct(Wrappable $itemToWrap, ElementId $elementId)
    {
        $this->contents  = $itemToWrap;
        $this->elementId = $elementId;
		$this->options = array();
    }

    /**
     * Unwraps and returns the wrapped object.
     *
     * @return \Andrewskm\Lavacharts\Support\Contracts\WrappableInterface
     */
    public function unwrap()
    {
        return $this->contents;
    }

    /**
     * Custom serialization of the Wrapper.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge($this->options, [
            'options'     => $this->contents,
            'containerId' => (string) $this->elementId,
            $this->contents->getWrapType() => $this->contents->getType()
        ]);
    }

    /**
     * Returns the JSON serialized version of the Wrapper.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this);
    }

    /**
     * Returns a javascript string of the visualization class for the Wrapper.
     *
     * @return string
     */
    public function getJsClass()
    {
        return 'google.visualization.' . static::TYPE;
    }

    /**
     * Returns a javascript string with the constructor for the Wrapper.
     *
     * @return string
     */
    public function getJsConstructor()
    {
        return sprintf('new %s(%s)', $this->getJsClass(), $this->toJson());
    }
}
