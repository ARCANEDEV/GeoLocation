<?php namespace Arcanedev\GeoLocation\Google\Elevation\Entities;

use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Traits\CanBeJsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use JsonSerializable;

/**
 * Class     Elevation
 *
 * @package  Arcanedev\GeoLocation\Google\Elevation\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Elevation implements Arrayable, Jsonable, JsonSerializable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use CanBeJsonable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The elevation value.
     *
     * @var float
     */
    protected $value;

    /**
     * The location.
     *
     * @var \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    protected $location;

    /**
     * The resolution.
     *
     * @var float
     */
    protected $resolution;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Elevation constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->value      = Arr::get($data, 'elevation', 0.0);
        $this->location   = Position::createFromArray(Arr::get($data, 'location', []));
        $this->resolution = Arr::get($data, 'resolution', 0.0);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the elevation value.
     *
     * @return float
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Get the location.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function location()
    {
        return $this->location;
    }

    /**
     * Get the resolution.
     *
     * @return float
     */
    public function resolution()
    {
        return $this->resolution;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'elevation'  => $this->value(),
            'location'   => $this->location()->toArray(),
            'resolution' => $this->resolution(),
        ];
    }
}
