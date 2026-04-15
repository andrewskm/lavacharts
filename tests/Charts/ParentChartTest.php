<?php

namespace Andrewskm\Lavacharts\Tests\Charts;

use \Andrewskm\Lavacharts\Tests\ProvidersTestCase;

/**
 * @property \Andrewskm\Lavacharts\Tests\Charts\MockChart mockChart
 */
class ChartAndTraitsTest extends ProvidersTestCase
{
    public function setUp()
    {
        parent::setUp();

        $label = \Mockery::mock('\Andrewskm\Lavacharts\Values\Label', ['TestChart'])->makePartial();

        $this->mockChart = new MockChart($label, $this->partialDataTable);
    }

    public function testLabelAssignedViaConstructor()
    {
        $this->assertEquals('TestChart', (string) $this->mockChart->getLabel());
    }

    public function testDataTable()
    {
        $this->mockChart->datatable($this->partialDataTable);

        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\DataTable', $this->mockChart->getDataTable());
    }

    public function testCustomizeMethodToSetOptions()
    {
        $this->mockChart->customize([
            'title'  => 'My Cool Chart',
            'width'  => 1024,
            'height' => 768
        ]);

        $options = $this->inspect($this->mockChart, 'options');

        $this->assertArrayHasKey('title', $options);
        $this->assertEquals('My Cool Chart', $options['title']);

        $this->assertArrayHasKey('width', $options);
        $this->assertEquals(1024, $options['width']);

        $this->assertArrayHasKey('height', $options);
        $this->assertEquals(768, $options['height']);
    }

    /**
     * @depends testCustomizeMethodToSetOptions
     */
    public function testOptionsToJson()
    {
        $this->mockChart->title('My Cool Chart');
        $this->mockChart->width(1024);
        $this->mockChart->height(768);

        $expected = '{"title":"My Cool Chart","width":1024,"height":768}';

        $this->assertEquals($expected, json_encode($this->mockChart));
    }
}
