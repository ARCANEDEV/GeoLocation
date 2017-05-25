<?php namespace Arcanedev\GeoLocation\Google\Directions\Entities;

use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Entities\Measures\Distance;
use Arcanedev\GeoLocation\Entities\Measures\Duration;
use Arcanedev\GeoLocation\Traits\CanBeJsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use JsonSerializable;

/**
 * Class     Leg
 *
 * @package  Arcanedev\GeoLocation\Google\Directions\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Leg implements Arrayable, Jsonable, JsonSerializable
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
     * The start address.
     *
     * @var string
     */
    protected $startAddress;

    /**
     * The start location.
     *
     * @var \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    protected $startLocation;

    /**
     * The end address
     *
     * @var string
     */
    protected $endAddress;

    /**
     * The end location.
     *
     * @var \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    protected $endLocation;

    /**
     * The distance (text + value).
     *
     * @var \Arcanedev\GeoLocation\Entities\Measures\Distance
     */
    protected $distance;

    /**
     * The duration (text + value).
     *
     * @var \Arcanedev\GeoLocation\Entities\Measures\Duration
     */
    protected $duration;

    /**
     * The steps collection.
     *
     * @var \Arcanedev\GeoLocation\Google\Directions\Entities\StepCollection
     */
    protected $steps;

    /**
     * The traffic speed entry.
     *
     * @var array
     */
    protected $trafficSpeedEntry;

    /**
     * The via waypoint.
     *
     * @var array
     */
    protected $viaWaypoint;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Leg constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->startAddress  = Arr::get($data, 'start_address', '');
        $this->startLocation = Position::createFromArray(Arr::get($data, 'start_location', ['lat' => 0, 'lng' => 0]));

        $this->endAddress    = Arr::get($data, 'end_address', '');
        $this->endLocation   = Position::createFromArray(Arr::get($data, 'end_location', ['lat' => 0, 'lng' => 0]));

        $this->distance      = Distance::makeFromArray(Arr::get($data, 'distance', ['text' => '', 'value' => 0]));
        $this->duration      = Duration::makeFromArray(Arr::get($data, 'duration', ['text' => '', 'value' => 0]));

        $this->steps         = StepCollection::load(Arr::get($data, 'steps', []));

        $this->trafficSpeedEntry = Arr::get($data, 'traffic_speed_entry', []);
        $this->viaWaypoint       = Arr::get($data, 'via_waypoint', []);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * @return string
     */
    public function startAddress()
    {
        return $this->startAddress;
    }

    /**
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function startLocation()
    {
        return $this->startLocation;
    }

    /**
     * @return string
     */
    public function endAddress()
    {
        return $this->endAddress;
    }

    /**
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function endLocation()
    {
        return $this->endLocation;
    }

    /**
     * Get the distance.
     *
     * @return \Arcanedev\GeoLocation\Entities\Measures\Distance
     */
    public function distance()
    {
        return $this->distance;
    }

    /**
     * Get the duration.
     *
     * @return \Arcanedev\GeoLocation\Entities\Measures\Duration
     */
    public function duration()
    {
        return $this->duration;
    }

    /**
     * Get the step collection.
     *
     * @return \Arcanedev\GeoLocation\Google\Directions\Entities\StepCollection
     */
    public function steps()
    {
        return $this->steps;
    }

    /**
     * Get the traffic speed entry.
     *
     * @return array
     */
    public function trafficSpeedEntry()
    {
        return $this->trafficSpeedEntry;
    }

    /**
     * Get the via waypoint.
     *
     * @return array
     */
    public function viaWaypoint()
    {
        return $this->viaWaypoint;
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
            'start_address'       => $this->startAddress(),
            'start_location'      => $this->startLocation()->toArray(),
            'end_address'         => $this->endAddress(),
            'end_location'        => $this->endLocation()->toArray(),
            'distance'            => $this->distance()->toArray(),
            'duration'            => $this->duration()->toArray(),
            'steps'               => $this->steps()->toArray(),
            'traffic_speed_entry' => $this->trafficSpeedEntry(),
            'via_waypoint'        => $this->viaWaypoint(),
        ];
    }
}
