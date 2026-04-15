<?php

namespace Andrewskm\Lavacharts\Tests\Builders;

use Andrewskm\Lavacharts\Builders\ChartBuilder;
use Andrewskm\Lavacharts\Charts\LineChart;
use Andrewskm\Lavacharts\Tests\ProvidersTestCase;

/**
 * @property \Andrewskm\Lavacharts\Builders\ChartBuilder builder
 */
class ChartBuilderTest extends ProvidersTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->builder = new ChartBuilder();
    }

    public function testWithLabelAndDataTable()
    {
        $this->builder->setType('LineChart');
        $this->builder->setLabel('taco');
        $this->builder->setDatatable($this->getMockDataTable());

        $chart = $this->builder->getChart();

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Charts\LineChart', $chart);
        $this->assertEquals('taco', $chart->getLabelStr());
        $this->assertInstanceOf('\Andrewskm\Lavacharts\Datatables\Datatable', $chart->getDataTable());
    }

    /**
     * @depends testWithLabelAndDataTable
     */
    public function testWithLabelAndDataTableAndOptions()
    {
        $this->builder->setType('LineChart');
        $this->builder->setLabel('taco');
        $this->builder->setDatatable($this->getMockDataTable());
        $this->builder->setOptions(['tacos' => 'good']);

        $chart = $this->builder->getChart();
        $options = $chart->getOptions();

        $this->assertArrayHasKey('tacos', $options);
        $this->assertEquals('good', $options['tacos']);
    }

    /**
     * @depends testWithLabelAndDataTable
     * @depends testWithLabelAndDataTableAndOptions
     */
    public function testWithLabelAndDataTableAndOptionsAndElementId()
    {
        $this->builder->setType('LineChart');
        $this->builder->setLabel('taco');
        $this->builder->setDatatable($this->getMockDataTable());
        $this->builder->setOptions(['tacos' => 'good']);
        $this->builder->setElementId('platter');

        $chart = $this->builder->getChart();

        $elementId = $this->inspect($chart, 'elementId');

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Values\ElementId', $elementId);
        $this->assertEquals('platter', (string) $elementId);
    }
}
