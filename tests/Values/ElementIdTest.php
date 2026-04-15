<?php

namespace Andrewskm\Lavacharts\Tests\Values;

use Andrewskm\Lavacharts\Tests\ProvidersTestCase;
use Andrewskm\Lavacharts\Values\ElementId;

class ElementIdTest extends ProvidersTestCase
{
    public function testElementIdWithString()
    {
        $elementId = new ElementId('chart');

        $this->assertEquals('chart', (string) $elementId);
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Andrewskm\Lavacharts\Exceptions\InvalidElementId
     */
    public function testElementIdWithBadTypes($badTypes)
    {
        $elementId = new ElementId($badTypes);
    }
}
