<?php namespace Arcanedev\GeoLocation\Contracts;

/**
 * Interface  GoogleManager
 *
 * @package   Arcanedev\GeoLocation\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface GoogleManager
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create the google directions service.
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function createDirectionsDriver();

    /**
     * Create the google distance matrix service.
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function createDistanceMatrixDriver();

    /**
     * Create the google elevation service.
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function createElevationDriver();

    /**
     * Create the google geocoding service.
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function createGeocodingDriver();
}
