[![Build Status](https://travis-ci.org/hotrush/angular-sweep.svg?branch=master)](https://travis-ci.org/hotrush/angular-sweep)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hotrush/angular-sweep/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hotrush/angular-sweep/?branch=master)
[![Packagist](https://img.shields.io/packagist/v/hotrush/angular-sweep.svg?label=Packagist)](https://packagist.org/packages/hotrush/angular-sweep)

## PHP implementation of angular sweep algorithm

Solves issue of finding maximum points that can be enclosed in a circle of given radius and getting the center of this point.

[https://en.wikipedia.org/wiki/Visibility_polygon#Angular_sweep](https://en.wikipedia.org/wiki/Visibility_polygon#Angular_sweep)

[https://www.geeksforgeeks.org/angular-sweep-maximum-points-can-enclosed-circle-given-radius/](https://www.geeksforgeeks.org/angular-sweep-maximum-points-can-enclosed-circle-given-radius/)

[https://github.com/pear/Math_Complex/blob/master/Math/Complex.php](https://github.com/pear/Math_Complex/blob/master/Math/Complex.php)

### Installation

```bash
composer require hotrush/angular-sweep
```

### Usage

```php
use Hotrush\AngularSweep\NumbersCollection;
use Hotrush\AngularSweep\ComplexNumber;
use Hotrush\AngularSweep\AngularSweep;

$coordinates = [
    [6.47634, 7.69628],
    [5.16828, 4.79915],
    [6.69533, 6.20378],
];

$collection = new NumbersCollection();

foreach ($coordinates as $coordinate) {
    $collection->add(new ComplexNumber($coordinate[0], $coordinate[1]));
}

$radius = 1;

$sweep = new AngularSweep($collection, $radius);

echo $sweep->getMax();
// 2

$center = $sweep->getMaxCenter();
echo $center->getReal() . '-' . $center->getIm();
// '6.47634-7.69628'
```

### Testing

```bash
phpunit
```

##### FYI

[https://www.geeksforgeeks.org/find-minimum-radius-atleast-k-point-lie-inside-circle/](https://www.geeksforgeeks.org/find-minimum-radius-atleast-k-point-lie-inside-circle/)
