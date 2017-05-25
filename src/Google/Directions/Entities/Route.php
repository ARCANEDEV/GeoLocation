<?php namespace Arcanedev\GeoLocation\Google\Directions\Entities;

use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Entities\Coordinates\Viewport;
use Arcanedev\GeoLocation\Traits\CanBeJsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use JsonSerializable;

/**
 * Class     Route
 *
 * @package  Arcanedev\GeoLocation\Google\Directions\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Route implements Arrayable, Jsonable, JsonSerializable
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
     * The summary.
     *
     * @var string
     */
    protected $summary;

    /**
     * The legs.
     *
     * @var \Arcanedev\GeoLocation\Google\Directions\Entities\LegCollection
     */
    protected $legs;

    /**
     * The copyrights.
     *
     * @var string
     */
    protected $copyrights;

    /**
     * The bounds.
     *
     * @var  \Arcanedev\GeoLocation\Entities\Coordinates\Viewport
     */
    protected $bounds;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Route constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->summary    = Arr::get($data, 'summary', '');
        $this->legs       = LegCollection::load(Arr::get($data, 'legs', []));
        $this->copyrights = Arr::get($data, 'copyrights');
        $this->setBounds(Arr::get($data, 'bounds', []));
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the route summary.
     *
     * @return string
     */
    public function summary()
    {
        return $this->summary;
    }

    /**
     * @param  array  $bounds
     *
     * @return self
     */
    private function setBounds(array $bounds)
    {
        $this->bounds = Viewport::create(
            Position::create(Arr::get($bounds, 'northeast.lat'), Arr::get($bounds, 'northeast.lng')),
            Position::create(Arr::get($bounds, 'southwest.lat'), Arr::get($bounds, 'southwest.lng'))
        );

        return $this;
    }

    /**
     * Get the leg collection.
     *
     * @return \Arcanedev\GeoLocation\Google\Directions\Entities\LegCollection
     */
    public function legs()
    {
        return $this->legs;
    }

    /**
     * Get the copyrights.
     *
     * @return string
     */
    public function copyrights()
    {
        return $this->copyrights;
    }

    /**
     * Get the bounds.
     *
     * @return \Arcanedev\GeoLocation\Entities\Coordinates\Viewport
     */
    public function bounds()
    {
        return $this->bounds;
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
            'summary'    => $this->summary(),
            'legs'       => $this->legs()->toArray(),
            'copyrights' => $this->copyrights(),
            'bounds'     => $this->bounds()->toArray(),
        ];
    }
}
