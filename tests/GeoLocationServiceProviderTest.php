<?php namespace Arcanedev\GeoLocation\Tests;

use Arcanedev\GeoLocation\GeoLocationServiceProvider;

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
            static::assertInstanceOf($expected, $provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [];

        static::assertSame($expected, $this->getServiceProvider()->provides());
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
