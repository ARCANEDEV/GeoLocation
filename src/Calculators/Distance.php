<?php namespace Arcanedev\GeoLocation\Calculators;

use Arcanedev\GeoLocation\Contracts\Calculators\Distance as DistanceContract;

/**
 * Class     Distance
 *
 * @package  Arcanedev\GeoLocation\Calculators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Distance implements DistanceContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var float */
    private $value;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Distance constructor.
     *
     * @param  float  $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the distance value.
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the rounded distance value.
     *
     * @param  int  $precision
     *
     * @return float
     */
    public function value($precision = 2)
    {
        return round($this->getValue(), $precision);
    }

    /**
     * Get the unit in which the length of the distance is expressed.
     *
     * @return string
     */
    public function getUnit()
    {
        return 'meters';
    }
}
