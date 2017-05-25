<?php namespace Arcanedev\GeoLocation\Google\Directions\Entities;

use Illuminate\Support\Collection;

/**
 * Class     Routes
 *
 * @package  Arcanedev\GeoLocation\Google\Directions\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteCollection extends Collection
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Load the routes data.
     *
     * @param  array  $routes
     *
     * @return self
     */
    public static function load(array $routes)
    {
        $collect = new static;

        foreach ($routes as $route) {
            $collect->push(new Route($route));
        }

        return $collect;
    }
}
