<?php

namespace Hotrush\AngularSweep;

class AngularSweep
{
    /**
     * @var NumbersCollection
     */
    private $numbersCollection;

    /**
     * @var float
     */
    private $radius;

    /**
     * @var array
     */
    private $distances = [];

    /**
     * @var int
     */
    private $max = 0;

    /**
     * @var null|int
     */
    private $maxCenterKey;

    /**
     * AngularSweep constructor.
     *
     * @param NumbersCollection $numbersCollection
     * @param $radius
     * @throws \Exception
     */
    public function __construct(NumbersCollection $numbersCollection, $radius)
    {
        $this->numbersCollection = $numbersCollection;
        $this->radius = floatval($radius);
        $this->calculateDistances();
        $this->findMaxPoint();
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return ComplexNumber
     */
    public function getMaxCenter()
    {
        if (is_null($this->maxCenterKey)) {
            throw new \InvalidArgumentException('No center found.');
        }

        return $this->numbersCollection->get($this->maxCenterKey);
    }

    /**
     * Calculate distances between points.
     *
     * @return void
     */
    private function calculateDistances()
    {
        for ($i = 0; $i < $this->numbersCollection->total() - 1; $i++) {
            for ($j = $i + 1; $j < $this->numbersCollection->total(); $j++) {
                $this->distances[$i][$j] = $this->distances[$j][$i] =
                    $this->numbersCollection->get($i)->subtract($this->numbersCollection->get($j))->abs();
            }
        }
    }

    /**
     * Find the max points number inside circle and get the center.
     *
     * @return void
     * @throws \Exception
     */
    private function findMaxPoint()
    {
        for ($i = 0; $i < $this->numbersCollection->total(); $i++) {
            $max = $this->getPointsInside($i);
            if ($max > $this->max) {
                $this->max = $max;
                $this->maxCenterKey = $i;
            }
        }
    }

    /**
     * Get points number inside circle.
     *
     * @param $i
     * @return int
     * @throws \Exception
     */
    private function getPointsInside($i)
    {
        $angles = [];

        for ($j = 0; $j < $this->numbersCollection->total(); $j++) {
            if ($i !== $j && $this->distances[$i][$j] <= 2 * $this->radius) {
                $B = acos($this->distances[$i][$j] / (2 * $this->radius));
                $A = $this->numbersCollection->get($j)->subtract($this->numbersCollection->get($i))->arg();
                $alpha = $A - $B;
                $beta = $A + $B;
                $angles[] = [$alpha, true];
                $angles[] = [$beta, false];
            }
        }

        usort($angles, function ($a, $b) {
            if ($a === $b) {
                return 0;
            }
            return $a > $b ? 1 : -1;
        });

        $count = 1; $res = 1;
        foreach ($angles as $angle) {
            if ($angle[1]) {
                $count++;
            } else {
                $count--;
            }
            if ($count > $res) {
                $res = $count;
            }
        }

        return $res;
    }
}