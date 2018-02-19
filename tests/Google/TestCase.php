<?php namespace Arcanedev\GeoLocation\Tests\Google;

use Arcanedev\GeoLocation\Contracts\GoogleManager;
use Arcanedev\GeoLocation\Tests\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\GeoLocation\Tests\Google
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* -----------------------------------------------------------------
     |  Common Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the google manager.
     *
     * @return GoogleManager
     */
    public function manager()
    {
        return $this->app->make(GoogleManager::class);
    }
}
