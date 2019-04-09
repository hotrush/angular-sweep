<?php

namespace Hotrush\AngularSweep\Tests;

use Hotrush\AngularSweep\ComplexNumber;
use Hotrush\AngularSweep\NumbersCollection;
use PHPUnit\Framework\TestCase;

class AngularSweepTest extends TestCase
{
    private $data = [
        1 => [
            'data' => [
                [6.47634, 7.69628], [5.16828, 4.79915], [6.69533, 6.20378],
            ],
            'max' => 2,
            'center' => [6.47634, 7.69628],
        ],
        2 => [
            'data' => [
                [6.42743, 6.26189], [6.65128, 5.47490], [6.35864, 4.61611], [6.59020, 4.54228], [4.43967, 5.70059],
                [4.38226, 5.70536], [5.50755, 6.18163], [7.41971, 6.13668], [6.71936, 3.04496], [5.61832, 4.23857],
                [5.99424, 4.29328], [5.60961, 4.32998], [6.82242, 5.79683], [5.44693, 3.82724], [6.70906, 3.65736],
                [7.89087, 5.68000], [6.23300, 4.59530], [5.92401, 4.92329], [6.24168, 3.81389], [6.22671, 3.62210],
            ],
            'max' => 11,
            'center' => [6.65128, 5.47490],
        ],
    ];

    private $radius = 1;

    private function getNumbersCollection($key)
    {
        $collection = new NumbersCollection();

        foreach ($this->data[$key]['data'] as $row) {
            $collection->add(new ComplexNumber($row[0], $row[1]));
        }

        return $collection;
    }

    public function testAngularSweep()
    {
        foreach (array_keys($this->data) as $key) {
            $collection = $this->getNumbersCollection($key);
            $sweep = new \Hotrush\AngularSweep\AngularSweep($collection, $this->radius);
            $this->assertEquals($this->data[$key]['max'], $sweep->getMax());
            $center = $sweep->getMaxCenter();
            $this->assertEquals($this->data[$key]['center'][0], $center->getReal());
            $this->assertEquals($this->data[$key]['center'][1], $center->getIm());
        }
    }
}