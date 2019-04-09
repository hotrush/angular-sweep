<?php

namespace Hotrush\AngularSweep\Tests;

use Hotrush\AngularSweep\ComplexNumber;
use PHPUnit\Framework\TestCase;

class ComplexNumberTest extends TestCase
{
    public function testComplexNumber()
    {
        $number = new ComplexNumber(1, 2);

        $this->assertInstanceOf(ComplexNumber::class, $number);
        $this->assertEquals(1, $number->getReal());
        $this->assertEquals(2, $number->getIm());
        $this->assertEquals('1 + 2i', $number->toString());
        $this->assertEquals(5, $number->abs2());
        $this->assertEquals(2.23606797749979, $number->abs());
        $this->assertEquals(1.1071487177940904, $number->arg());
        $this->assertEquals(1.1071487177940904, $number->angle());

        $secondNumber = new ComplexNumber(2, 3);

        $subtracted = $number->subtract($secondNumber);
        $this->assertInstanceOf(ComplexNumber::class, $subtracted);
        $this->assertEquals(-1, $subtracted->getReal());
        $this->assertEquals(-1, $subtracted->getIm());
    }
}