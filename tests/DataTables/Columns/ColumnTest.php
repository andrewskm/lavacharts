<?php

namespace Andrewskm\Lavacharts\Tests\DataTables\Columns;

use Andrewskm\Lavacharts\Tests\ProvidersTestCase;
use Andrewskm\Lavacharts\DataTables\Columns\Column;

/**
 * @property \Mockery\Mock mockRole
 * @property \Mockery\Mock mockFormat
 */
class ColumnTest extends ProvidersTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->mockRole   = \Mockery::mock('\Andrewskm\Lavacharts\Values\Role')
                                    ->shouldReceive('__toString')
                                    ->zeroOrMoreTimes()
                                    ->andReturn('interval')
                                    ->getMock();

        $this->mockFormat = \Mockery::mock('\Andrewskm\Lavacharts\DataTables\Formats\NumberFormat')->makePartial();
    }

    /**
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::__construct
     */
    public function testConstructorWithType()
    {
        $column = new Column('number');

        $this->assertEquals('number', $this->inspect($column, 'type'));
    }

    /**
     * @depends testConstructorWithType
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::__construct
     */
    public function testConstructorWithTypeAndLabel()
    {
        $column = new Column('number', 'MyLabel');

        $this->assertEquals('MyLabel', $this->inspect($column, 'label'));
    }

    /**
     * @depends testConstructorWithTypeAndLabel
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::__construct
     */
    public function testConstructorWithTypeAndLabelAndFormat()
    {
        $column = new Column('number', 'MyLabel', $this->mockFormat);

        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\Formats\NumberFormat', $this->inspect($column, 'format'));
    }

    /**
     * @depends testConstructorWithTypeAndLabelAndFormat
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::__construct
     */
    public function testConstructorWithTypeAndLabelAndFormatAndRole()
    {
        $column = new Column('number', 'MyLabel', $this->mockFormat, $this->mockRole);

        $this->assertInstanceOf('\Andrewskm\Lavacharts\Values\Role', $this->inspect($column, 'role'));
    }

    /**
     * @depends testConstructorWithType
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::getType
     */
    public function testGetType()
    {
        $column = new Column('number');

        $this->assertEquals('number', $column->getType());
    }

    /**
     * @depends testConstructorWithTypeAndLabel
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::getLabel
     */
    public function testGetLabel()
    {
        $column = new Column('number', 'MyLabel');

        $this->assertEquals('MyLabel', $column->getLabel());
    }

    /**
     * @depends testConstructorWithTypeAndLabelAndFormat
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::isFormatted
     */
    public function testIsFormatted()
    {
        $column = new Column('number', 'MyLabel', $this->mockFormat);

        $this->assertTrue($column->isFormatted());
    }

    /**
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::getFormat
     */
    public function testGetFormat()
    {
        $column = new Column('number', 'MyLabel', $this->mockFormat);

        $this->assertInstanceOf('\Andrewskm\Lavacharts\DataTables\Formats\NumberFormat', $column->getFormat());
    }

    /**
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::getRole
     */
    public function testGetRole()
    {
        $column = new Column('number', 'MyLabel', $this->mockFormat, $this->mockRole);

        $this->assertEquals('interval', $column->getRole());
    }

    /**
     * @depends testConstructorWithTypeAndLabelAndFormatAndRole
     * @covers \Andrewskm\Lavacharts\DataTables\Columns\Column::jsonSerialize
     */
    public function testJsonSerialization()
    {
        $column = new Column('number', 'MyLabel', $this->mockFormat, $this->mockRole);

        $json = '{"type":"number","label":"MyLabel","p":{"role":"interval"}}';

        $this->assertEquals($json, json_encode($column));
    }
}



