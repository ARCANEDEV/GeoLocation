<?php namespace Arcanedev\GeoLocation\Entities;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinate;
use Arcanedev\GeoLocation\Exceptions\InvalidCoordinateException;

/**
 * Class     AbstractCoordinate
 *
 * @package  Arcanedev\GeoLocation\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractCoordinate implements Coordinate
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * The coordinate value.
     *
     * @var float
     */
    private $value;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AbstractCoordinate constructor.
     *
     * @param  float  $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the coordinate's value (alias).
     */
    public function value()
    {
        return $this->getValue();
    }

    /**
     * Get the coordinate's value.
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the coordinate value.
     *
     * @param  float  $value
     *
     * @return self
     */
    public function setValue($value)
    {
        $this->checkValue($value);
        $this->value = (float) $value;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the given value.
     *
     * @param  float  $value
     */
    private function checkValue($value)
    {
        if ( ! is_numeric($value)) {
            throw new InvalidCoordinateException('The coordinate value must be numeric.');
        }

        if ($value < static::getMin() || $value > static::getMax()) {
            throw new InvalidCoordinateException(
                'The coordinate value must be between `'.static::getMin().'` & `'.static::getMax().'`, `'.$value.'` was given.'
            );
        }
    }
}
