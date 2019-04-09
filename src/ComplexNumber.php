<?php

namespace Hotrush\AngularSweep;

class ComplexNumber
{
    /**
     * The real part of the complex number
     *
     * @var float
     * @access  private
     */
    private $_real;
    /**
     * The imaginary part of the complex number
     *
     * @var float
     * @access  private
     */
    private $_im;

    /**
     * Constructor for ComplexNumberPoint
     *
     * @param float $real Real part of the number
     * @param float $im Imaginary part of the number
     */
    public function __construct($real, $im)
    {
        $this->_real = floatval($real);
        $this->_im = floatval($im);
    }

    /**
     * Simple string representation of the number.
     *
     * @return string
     */
    public function toString()
    {
        $r = $this->getReal();
        $i = $this->getIm();
        $str = $r;
        $str .= ($i < 0) ? ' - ' : ' + ';
        $str .= abs($i) . 'i';
        return $str;
    }

    /**
     * Returns the square of the magnitude of the number.
     *
     * @return float
     */
    public function abs2()
    {
        return ($this->_real * $this->_real + $this->_im * $this->_im);
    }

    /**
     * Returns the magnitude (also referred as norm) of the number.
     *
     * @return float
     */
    public function abs()
    {
        return sqrt($this->abs2());
    }

    /**
     * Returns the argument of the complex number.
     *
     * @return float A floating point number on success
     * @throws \Exception
     */
    public function arg()
    {
        $arg = atan2($this->_im, $this->_real);
        if (M_PI < $arg || $arg < -1 * M_PI) {
            throw new \Exception('Argument has an impossible value');
        } else {
            return $arg;
        }
    }

    /**
     * Returns the angle (argument) associated with the complex number.
     *
     * @return mixed A float on success
     * @throws \Exception
     */
    public function angle()
    {
        return $this->arg();
    }

    /**
     * Returns the real part of the complex number.
     *
     * @return float
     */
    public function getReal()
    {
        return $this->_real;
    }

    /**
     * Returns the imaginary part of the complex number.
     * @return float
     */
    public function getIm()
    {
        return $this->_im;
    }

    /**
     * Subtract complex number.
     *
     * @param ComplexNumber $number
     * @return ComplexNumber
     */
    public function subtract(ComplexNumber $number)
    {
        return new ComplexNumber(
            $this->getReal() - $number->getReal(),
            $this->getIm() - $number->getIm()
        );
    }
}