<?php

namespace Andrewskm\Lavacharts\Tests\DataTables\Columns;

use Andrewskm\Lavacharts\Tests\ProvidersTestCase;
use Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory;

class ColumnFactoryTest extends ProvidersTestCase
{
    /**
     * @var \Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory
     */
    public $columnFactory;

    public function setUp()
    {
        parent::setUp();

        $this->columnFactory = new ColumnFactory;
    }

    /**
     * @dataProvider columnTypeProvider
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory::create
     */
    public function testCreateColumnsWithType($columnType)
    {
        $column = $this->columnFactory->create($columnType);

        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\Columns\Column', $column);
        $this->assertEquals($columnType, $this->inspect($column, 'type'));
    }

    /**
     * @expectedException \Andrewskm\Lavacharts\Exceptions\InvalidColumnType
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory::create
     */
    public function testCreateColumnsWithBadValue()
    {
        $this->columnFactory->create('milkshakes');
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Andrewskm\Lavacharts\Exceptions\InvalidColumnType
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory::create
     */
    public function testCreateColumnsWithBadTypes($badTypes)
    {
        $this->columnFactory->create($badTypes);
    }

    /**
     * @dataProvider columnTypeProvider
     * @depends testCreateColumnsWithType
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory::create
     */
    public function testCreateColumnsWithTypeAndLabel($columnType)
    {
        $column = $this->columnFactory->create($columnType, 'Label');

        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\Columns\Column', $column);
        $this->assertEquals($columnType, $this->inspect($column, 'type'));
        $this->assertEquals('Label', $this->inspect($column, 'label'));
    }

    /**
     * @dataProvider columnTypeProvider
     * @depends testCreateColumnsWithTypeAndLabel
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory::create
     */
    public function testCreateColumnsWithTypeAndLabelAndFormat($columnType)
    {
        $mockFormat = \Mockery::mock('\Andrewskm\Lavacharts\DataTables\Formats\NumberFormat')->makePartial();

        $column = $this->columnFactory->create($columnType, 'Label', $mockFormat);

        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\Columns\Column', $column);
        $this->assertEquals($columnType, $this->inspect($column, 'type'));
        $this->assertEquals('Label', $this->inspect($column, 'label'));
        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\Formats\NumberFormat', $this->inspect($column, 'format'));
    }

    /**
     * @dataProvider columnTypeProvider
     * @depends testCreateColumnsWithTypeAndLabelAndFormat
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory::create
     */
    public function testCreateColumnsWithTypeAndLabelAndFormatAndRole($columnType)
    {
        $mockFormat = \Mockery::mock('\Andrewskm\Lavacharts\DataTables\Formats\NumberFormat')->makePartial();

        $column = $this->columnFactory->create($columnType, 'Label', $mockFormat, 'interval');

        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\Columns\Column', $column);
        $this->assertEquals($columnType, $this->inspect($column, 'type'));
        $this->assertEquals('Label', $this->inspect($column, 'label'));
        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\Formats\NumberFormat', $this->inspect($column, 'format'));
        $this->assertInstanceOf('\Andrewskm\Lavacharts\Values\Role', $this->inspect($column, 'role'));
        //@TODO remove me
        //$this->assertEquals('interval', $this->inspect($column, 'role'));
    }

    /**
     * @depends testCreateColumnsWithTypeAndLabelAndFormatAndRole
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\ColumnFactory::create
     * @expectedException \Andrewskm\Lavacharts\Exceptions\InvalidColumnRole
     */
    public function testCreateColumnsWithTypeAndLabelAndFormatAndRoleWithBadRole()
    {
        $mockFormat = \Mockery::mock('\Andrewskm\Lavacharts\DataTables\Formats\NumberFormat')->makePartial();

        $this->columnFactory->create('number', 'Label', $mockFormat, 'tacos');
    }
}
