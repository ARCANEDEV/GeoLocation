<?php namespace Arcanedev\GeoLocation\Tests;

use Arcanedev\GeoLocation\GeoLocationServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class     GeoLocationServiceProviderTest
 *
 * @package  Arcanedev\GeoLocation\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoLocationServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $provider = $this->getServiceProvider();

        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanedev\Support\PackageServiceProvider::class,
            \Arcanedev\GeoLocation\GeoLocationServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [];

        $this->assertSame($expected, $this->getServiceProvider()->provides());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the service provider.
     *
     * @return \Illuminate\Support\ServiceProvider|null
     */
    private function getServiceProvider()
    {
        return $this->app->getProvider(GeoLocationServiceProvider::class);
    }
}
