<?php namespace Arcanedev\GeoLocation\Google\Directions\Entities;

use Arcanedev\GeoLocation\Entities\Measures\Distance;
use Arcanedev\GeoLocation\Entities\Measures\Duration;
use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Traits\CanBeJsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use JsonSerializable;

/**
 * Class     Step
 *
 * @package  Arcanedev\GeoLocation\Google\Directions\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Step implements Arrayable, Jsonable, JsonSerializable
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
     * The start location.
     *
     * @var \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    protected $start;

    /**
     * The end location.
     *
     * @var \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    protected $end;

    /**
     * The distance.
     *
     * @var \Arcanedev\GeoLocation\Entities\Measures\Distance
     */
    protected $distance;

    /**
     * The duration.
     *
     * @var \Arcanedev\GeoLocation\Entities\Measures\Duration
     */
    protected $duration;

    /**
     * The travel mode.
     *
     * @var string
     */
    protected $mode;

    /**
     * The instructions (HTML format).
     *
     * @var string
     */
    protected $instructions;

    /**
     * The polyline.
     *
     * @var array
     */
    protected $polyline;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Step constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->start        = Position::createFromArray(Arr::get($data, 'start_location', ['lat' => 0, 'lng' => 0]));
        $this->end          = Position::createFromArray(Arr::get($data, 'end_location', ['lat' => 0, 'lng' => 0]));
        $this->distance     = Distance::makeFromArray(Arr::get($data, 'distance', ['text' => '', 'value' => 0]));
        $this->duration     = Duration::makeFromArray(Arr::get($data, 'duration', ['text' => '', 'value' => 0]));
        $this->mode         = Arr::get($data, 'travel_mode');
        $this->instructions = Arr::get($data, 'html_instructions');
        $this->polyline     = Arr::get($data, 'polyline', []);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the start location.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function start()
    {
        return $this->start;
    }

    /**
     * Get the end location.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function end()
    {
        return $this->end;
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
     * Get the traveling mode.
     *
     * @return string
     */
    public function mode()
    {
        return $this->mode;
    }

    /**
     * Get the instructions (HTML format)
     * @return string
     */
    public function instructions()
    {
        return $this->instructions;
    }

    /**
     * Get the polyline.
     *
     * @return array
     */
    public function polyline()
    {
        return $this->polyline;
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
            'start'        => $this->start()->toArray(),
            'end'          => $this->end()->toArray(),
            'distance'     => $this->distance()->toArray(),
            'duration'     => $this->duration()->toArray(),
            'mode'         => $this->mode(),
            'instructions' => $this->instructions(),
            'polyline'     => $this->polyline(),
        ];
    }
}
