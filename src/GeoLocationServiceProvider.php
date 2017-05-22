<?php namespace Arcanedev\GeoLocation;

use Arcanedev\Support\PackageServiceProvider;

/**
 * Class     GeoLocationServiceProvider
 *
 * @package  Arcanedev\GeoLocation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoLocationServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'geo-location';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            //
        ];
    }
}
