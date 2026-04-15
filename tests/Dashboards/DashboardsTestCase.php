<?php

namespace Andrewskm\Lavacharts\Tests\Dashboards;

use Andrewskm\Lavacharts\Tests\Charts\MockChart;
use Andrewskm\Lavacharts\Tests\ProvidersTestCase;

/**
 * @property \Mockery\Mock                            mockChartWrap
 * @property \Mockery\Mock                            mockControlWrap
 * @property \Andrewskm\Lavacharts\Tests\Charts\MockChart mockChart
 */
class DashboardsTestCase extends ProvidersTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->mockChart = new MockChart(
            \Mockery::mock('\Andrewskm\Lavacharts\Values\Label', ['TestChart'])->makePartial(),
            $this->partialDataTable
        );

        $this->mockChartWrap = \Mockery::mock('\Andrewskm\Lavacharts\Dashboards\Wrappers\ChartWrapper', [
            $this->mockChart,
            \Mockery::mock('\Andrewskm\Lavacharts\Values\ElementId', ['chart-div'])->makePartial()
        ])->makePartial();

        $this->mockControlWrap = \Mockery::mock('\Andrewskm\Lavacharts\Dashboards\Wrappers\ControlWrapper', [
            \Mockery::mock('\Andrewskm\Lavacharts\Dashboards\Filters\NumberRangeFilter')->makePartial(),
            \Mockery::mock('\Andrewskm\Lavacharts\Values\ElementId', ['control-div'])->makePartial()
        ])->makePartial();
    }
}
