<?php namespace Arcanedev\GeoLocation\Google;

use Arcanedev\GeoLocation\Contracts\GoogleManager as GoogleManagerContract;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Manager;
use InvalidArgumentException;

/**
 * Class     GoogleManager
 *
 * @package  Arcanedev\GeoLocation\Google
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GoogleManager extends Manager implements GoogleManagerContract
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a google service.
     *
     * @param  string  $driver
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function driver($driver = null)
    {
        return parent::driver($driver);
    }

    /**
     * Create the google directions service.
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function createDirectionsDriver()
    {
        return $this->buildService('directions');
    }

    /**
     * Create the google distance matrix service.
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function createDistanceMatrixDriver()
    {
        return $this->buildService('distance-matrix');
    }

    /**
     * Create the google elevation service.
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function createElevationDriver()
    {
        return $this->buildService('elevation');
    }

    /**
     * Create the google geocoding service.
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    public function createGeocodingDriver()
    {
        return $this->buildService('geocoding');
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No google service was specified.');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Build a google service.
     *
     * @param  string  $name
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractService
     */
    protected function buildService($name)
    {
        $service = $this->config()->get("geo-location.services.google.{$name}.service");

        return new $service(
            $this->getHttpClient(),
            $this->config()->get("geo-location.services.google.{$name}.options", [])
        );
    }

    /**
     * Get the config repository.
     *
     * @return mixed
     */
    protected function config()
    {
        return $this->app['config'];
    }

    /**
     * Get the http client.
     *
     * @return \GuzzleHttp\ClientInterface
     */
    protected function getHttpClient()
    {
        return $this->app->make(ClientInterface::class);
    }
}
