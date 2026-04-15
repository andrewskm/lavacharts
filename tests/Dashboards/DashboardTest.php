<?php

namespace Andrewskm\Lavacharts\Tests\Dashboards;

use Andrewskm\Lavacharts\Dashboards\Dashboard;

/**
 * @property \Andrewskm\Lavacharts\Dashboards\Dashboard   dashboard
 */
class DashboardTest extends DashboardsTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->dashboard = new Dashboard(
            \Mockery::mock('\Andrewskm\Lavacharts\Values\Label', ['myDash'])->makePartial(),
            $this->partialDataTable,
            \Mockery::mock('\Andrewskm\Lavacharts\Values\ElementId', ['my-dash'])->makePartial()
        );
    }

    /**
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     * @expectedException \Andrewskm\Lavacharts\Exceptions\InvalidBindings
     */
    public function testBindingFactoryWithBadTypes()
    {
        $this->dashboard->bind(612345, 'tacos');
        $this->dashboard->bind(61.345, []);
        $this->dashboard->bind([], false);
    }
    /**
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::bind
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::getBindings
     */
    public function testGetBindings()
    {
        $this->dashboard->bind($this->mockControlWrap, $this->mockChartWrap);

        $bindings = $this->dashboard->getBindings();

        $this->assertTrue(is_array($bindings));
    }

    /**
     * @depends testGetBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::bind
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::getBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\OneToOne
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     */
    public function testBindWithOneToOne()
    {
        $this->dashboard->bind($this->mockControlWrap, $this->mockChartWrap);

        /** @var \Andrewskm\Lavacharts\Dashboards\Bindings\Binding $binding */
        $binding = $this->dashboard->getBindings()[0];

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\OneToOne', $binding);
    }

    /**
     * @depends testGetBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::bind
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::getBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\OneToMany
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     */
    public function testBindWithOneToMany()
    {
        $this->dashboard->bind(
            $this->mockControlWrap,
            [$this->mockChartWrap, $this->mockChartWrap]
        );

        /** @var \Andrewskm\Lavacharts\Dashboards\Bindings\Binding $binding */
        $binding = $this->dashboard->getBindings()[0];

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\OneToMany', $binding);
    }

    /**
     * @depends testGetBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::bind
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::getBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\ManyToOne
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     */
    public function testBindWithManyToOne()
    {
        $this->dashboard->bind(
            [$this->mockControlWrap, $this->mockControlWrap],
            $this->mockChartWrap
        );

        /** @var \Andrewskm\Lavacharts\Dashboards\Bindings\Binding $binding */
        $binding = $this->dashboard->getBindings()[0];

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\ManyToOne', $binding);
    }

    /**
     * @depends testGetBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::bind
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::getBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\ManyToMany
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     */
    public function testBindWithManyToMany()
    {
        $this->dashboard->bind(
            [$this->mockControlWrap, $this->mockControlWrap],
            [$this->mockChartWrap, $this->mockChartWrap]
        );

        /** @var \Andrewskm\Lavacharts\Dashboards\Bindings\Binding $binding */
        $binding = $this->dashboard->getBindings()[0];

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\ManyToMany', $binding);
    }

    /**
     * @depends testGetBindings
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::bind
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\Binding
     */
    public function testGettingComponentsFromBinding()
    {
        $this->dashboard->bind($this->mockControlWrap, $this->mockChartWrap);

        /** @var \Andrewskm\Lavacharts\Dashboards\Bindings\Binding $binding */
        $binding = $this->dashboard->getBindings()[0];

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\OneToOne', $binding);
        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Wrappers\ControlWrapper',$binding->getControlWrappers()[0]);
        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Wrappers\ChartWrapper', $binding->getChartWrappers()[0]);
    }
    /**
     * @depends testGetBindings
     * @depends testBindWithOneToMany
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::getBoundCharts
     */
    public function testGetBoundChartsWithOneToMany()
    {
        $mockLineChartWrapper = \Mockery::mock('\Andrewskm\Lavacharts\Dashboards\Wrappers\ChartWrapper', [
            \Mockery::mock('\Andrewskm\Lavacharts\Charts\LineChart')->makePartial(),
            \Mockery::mock('\Andrewskm\Lavacharts\Values\ElementId', ['line-chart'])->makePartial()
        ])->makePartial();
        //->shouldReceive('unwrap')
        //->once()->getMock();
        //->andReturn();

        $mockAreaChartWrapper = \Mockery::mock('\Andrewskm\Lavacharts\Dashboards\Wrappers\ChartWrapper', [
            \Mockery::mock('\Andrewskm\Lavacharts\Charts\AreaChart')->makePartial(),
            \Mockery::mock('\Andrewskm\Lavacharts\Values\ElementId', ['area-chart'])->makePartial()
        ])->makePartial();
        //->shouldReceive('unwrap')
        //->once()->getMock();
        //->andReturn();

        $this->dashboard->bind(
            $this->mockControlWrap,
            [$mockLineChartWrapper, $mockAreaChartWrapper]
        );

        $charts = $this->dashboard->getBoundCharts();

        $this->assertTrue(is_array($charts));
        $this->assertInstanceOf('\Andrewskm\Lavacharts\Charts\LineChart', $charts[0]);
        $this->assertInstanceOf('\Andrewskm\Lavacharts\Charts\AreaChart', $charts[1]);
    }

    /**
     * @depends testGetBindings
     * @depends testBindWithOneToOne
     * @covers \Andrewskm\Lavacharts\Dashboards\Dashboard::setBindings
     */
    public function testSetBindingsWithMultipleOneToOne()
    {
        $this->dashboard->setBindings([
            [$this->mockControlWrap, $this->mockChartWrap],
            [$this->mockControlWrap, $this->mockChartWrap]
        ]);

        $bindings = $this->dashboard->getBindings();

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\OneToOne', $bindings[0]);
        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\OneToOne', $bindings[1]);
    }
}
