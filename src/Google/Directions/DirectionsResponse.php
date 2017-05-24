<?php namespace Arcanedev\GeoLocation\Google\Directions;

use Arcanedev\GeoLocation\Google\AbstractResponse;

/**
 * Class     DirectionsResponse
 *
 * @package  Arcanedev\GeoLocation\Google\Directions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DirectionsResponse extends AbstractResponse
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  array */
    protected $geocodedWaypoints;

    /**
     * The routes collection.
     *
     * @var \Arcanedev\GeoLocation\Google\Directions\Entities\RouteCollection
     */
    protected $routes;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the geocoded waypoints.
     *
     * @return array
     */
    public function getGeocodedWaypoints()
    {
        return $this->get('geocoded_waypoints', []);
    }

    /**
     * Get the routes.
     *
     * @return \Arcanedev\GeoLocation\Google\Directions\Entities\RouteCollection
     */
    public function getRoutes()
    {
        if (is_null($this->routes)) {
            $this->routes = Entities\RouteCollection::load(
                $this->get('routes', [])
            );
        }

        return $this->routes;
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
            'geocoded_waypoints' => $this->getGeocodedWaypoints(),
            'routes'             => $this->getRoutes()->toArray(),
        ];
    }
}
