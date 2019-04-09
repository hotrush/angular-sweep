<?php

namespace Hotrush\AngularSweep;

class NumbersCollection
{
    /**
     * @var ComplexNumber[]
     */
    private $numbers = [];

    /**
     * @param ComplexNumber $number
     */
    public function add(ComplexNumber $number)
    {
        $this->numbers[] = $number;
    }

    /**
     * @return ComplexNumber[]
     */
    public function all()
    {
        return $this->numbers;
    }

    /**
     * @param $key
     * @return ComplexNumber
     */
    public function get($key)
    {
        if (!isset($this->numbers[$key])) {
            throw new \InvalidArgumentException('Number with this key doesn\'t exist');
        }

        return $this->numbers[$key];
    }

    /**
     * @return int
     */
    public function total()
    {
        return count($this->numbers);
    }
}