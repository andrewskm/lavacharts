<?php

namespace Andrewskm\Lavacharts\Tests\Values;

use Andrewskm\Lavacharts\Tests\ProvidersTestCase;
use Andrewskm\Lavacharts\Values\Label;

class LabelTest extends ProvidersTestCase
{
    public function testLabelWithString()
    {
        $label = new Label('TheChart');

        $this->assertEquals('TheChart', (string) $label);
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \Andrewskm\Lavacharts\Exceptions\InvalidLabel
     */
    public function testLabelWithBadTypes($badTypes)
    {
        $label = new Label($badTypes);
    }
}
