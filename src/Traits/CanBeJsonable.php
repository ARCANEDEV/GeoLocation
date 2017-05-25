<?php namespace Arcanedev\GeoLocation\Traits;

/**
 * Trait     JsonableEntity
 *
 * @package  Arcanedev\GeoLocation\Traits
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait CanBeJsonable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    abstract public function toArray();
}
