<?php

namespace Hotrush\AngularSweep\Tests;

use Hotrush\AngularSweep\ComplexNumber;
use Hotrush\AngularSweep\NumbersCollection;
use PHPUnit\Framework\TestCase;

class NumbersCollectionTest extends TestCase
{
    public function testNumbersCollection()
    {
        $collection = new NumbersCollection();

        $this->assertInstanceOf(NumbersCollection::class, $collection);

        $number1 = new ComplexNumber(1, 2);
        $number2 = new ComplexNumber(2, 3);

        $collection->add($number1);
        $collection->add($number2);

        $this->assertEquals(2, $collection->total());
        $this->assertIsArray($collection->all());
        $this->assertEquals(2, count($collection->all()));
        $this->assertInstanceOf(ComplexNumber::class, $collection->get(0));
        $this->assertEquals(1, $collection->get(0)->getReal());
        $this->expectException(\InvalidArgumentException::class);
        $collection->get(2);
    }
}