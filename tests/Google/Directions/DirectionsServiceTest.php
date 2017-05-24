<?php namespace Arcanedev\GeoLocation\Tests\Google\Directions;

use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Google\Directions\DirectionsService;
use Arcanedev\GeoLocation\Tests\TestCase;
use GuzzleHttp\Client;

/**
 * Class     DirectionsServiceTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Google\Directions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DirectionsServiceTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoLocation\Google\Directions\DirectionsService */
    protected $service;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp()
    {
        parent::setUp();

        $this->service = new DirectionsService(new Client);
    }

    protected function tearDown()
    {
        unset($this->service);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\GeoLocation\Google\AbstractService::class,
            \Arcanedev\GeoLocation\Google\Directions\DirectionsService::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->service);
        }
    }

    /** @test */
    public function it_can_get_directions()
    {
        $response = $this->service->from('Paris, France')
                                  ->to('Marseille, France')
                                  ->directions();

        $this->assertTrue($response->isOk());
        $this->assertFalse($response->getRoutes()->isEmpty());
    }

    /** @test */
    public function it_can_get_directions_with_coordinates()
    {
        $response = $this->service->fromCoordinates(48.854320, 2.341032)
                                  ->toCoordinates(43.296026, 5.369231)
                                  ->directions();

        $this->assertTrue($response->isOk());
        $this->assertFalse($response->getRoutes()->isEmpty());
    }

    /** @test */
    public function it_can_get_directions_with_position_objects()
    {
        $response = $this->service->fromPosition(Position::create(48.854320, 2.341032))
                                  ->toPosition(Position::create(43.296026, 5.369231))
                                  ->directions();

        $this->assertTrue($response->isOk());
        $this->assertFalse($response->getRoutes()->isEmpty());
    }

    /** @test */
    public function it_can_directions_with_place_ids()
    {
        $response = $this->service->fromPlace('ChIJD7fiBh9u5kcRYJSMaMOCCwQ')
                                  ->toPlace('ChIJM1PaREO_yRIRIAKX_aUZCAQ')
                                  ->directions();

        $this->assertTrue($response->isOk());
        $this->assertFalse($response->getRoutes()->isEmpty());
    }
}
