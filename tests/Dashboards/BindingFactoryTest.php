<?php

namespace Andrewskm\Lavacharts\Tests\Dashboards;

use Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory;

/**
 * @property \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory factory
 */
class BindingFactoryTest extends DashboardsTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->factory = new BindingFactory;
    }

    /**
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\OneToOne
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     */
    public function testBindWithOneToOne()
    {
        $binding = $this->factory->create($this->mockControlWrap, $this->mockChartWrap);

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\OneToOne', $binding);
    }

    /**
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\OneToMany
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     */
    public function testBindWithOneToMany()
    {
        $binding = $this->factory->create(
            $this->mockControlWrap,
            [$this->mockChartWrap, $this->mockChartWrap]
        );

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\OneToMany', $binding);
    }

    /**
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\ManyToOne
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     */
    public function testBindWithManyToOne()
    {
        $binding = $this->factory->create(
            [$this->mockControlWrap, $this->mockControlWrap],
            $this->mockChartWrap
        );

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\ManyToOne', $binding);
    }

    /**
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\ManyToMany
     * @covers \Andrewskm\Lavacharts\Dashboards\Bindings\BindingFactory::create
     */
    public function testBindWithManyToMany()
    {
        $binding = $this->factory->create(
            [$this->mockControlWrap, $this->mockControlWrap],
            [$this->mockChartWrap, $this->mockChartWrap]
        );

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Dashboards\Bindings\ManyToMany', $binding);
    }
}
