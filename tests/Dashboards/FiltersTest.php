<?php

namespace Andrewskm\Lavacharts\Tests\Dashboards\Filters;

use Andrewskm\Lavacharts\Dashboards\Filters\Filter;
use Andrewskm\Lavacharts\Dashboards\Filters\StringFilter;
use Andrewskm\Lavacharts\Tests\ProvidersTestCase;

class FiltersTest extends ProvidersTestCase
{
    public function filterTypeProvider()
    {
        return [
            ['CategoryFilter'],
            ['ChartRangeFilter'],
            ['DateRangeFilter'],
            ['NumberRangeFilter'],
            ['StringFilter']
        ];
    }

    /**
     * @dataProvider filterTypeProvider
     */
    public function testConstructorWithColumnIndex($filterType)
    {
        $filter = 'Andrewskm\Lavacharts\Dashboards\Filters\\'.$filterType;

        $filterClass = new $filter(2);

        $options = $this->inspect($filterClass, 'options');

        $this->assertEquals(2, $options['filterColumnIndex']);
    }

    /**
     * @dataProvider filterTypeProvider
     */
    public function testConstructorWithColumnLabel($filterType)
    {
        $filter = 'Andrewskm\Lavacharts\Dashboards\Filters\\'.$filterType;

        $filterClass = new $filter('myColumnLabel');

        $options = $this->inspect($filterClass, 'options');

        $this->assertEquals('myColumnLabel', $options['filterColumnLabel']);
    }

    /**
     * @dataProvider filterTypeProvider
     * @depends testConstructorWithColumnIndex
     */
    public function testConstructorWithColumnIndexAndOptions($filterType)
    {
        $filter = 'Andrewskm\Lavacharts\Dashboards\Filters\\'.$filterType;

        $filterClass = new $filter(2, ['floatOption' => 12.34]);

        $options = $this->inspect($filterClass, 'options');

        $this->assertEquals(12.34, $options['floatOption']);
    }

    /**
     * @dataProvider filterTypeProvider
     * @depends testConstructorWithColumnLabel
     */
    public function testGetWrapType($filterType)
    {
        $filter = 'Andrewskm\Lavacharts\Dashboards\Filters\\'.$filterType;

        $filterClass = new $filter('myColumnLabel');

        $this->assertEquals('controlType', $filterClass->getWrapType());
    }

    /**
     * @depends testConstructorWithColumnIndex
     * @expectedException \Andrewskm\Lavacharts\Exceptions\InvalidParamType
     */
    public function testConstructorWithInvalidType()
    {
        new StringFilter(new \stdClass());
    }

    /**
     * @dataProvider filterTypeProvider
     * @depends testConstructorWithColumnIndex
     * @covers \Andrewskm\Lavacharts\Dashboards\Filters\Filter::getType
     */
    public function testGetType($filterType)
    {
        $filter = 'Andrewskm\Lavacharts\Dashboards\Filters\\'.$filterType;

        $filterClass = new $filter('myColumnLabel');

        $this->assertEquals($filterType, $filterClass->getType());
    }
}
