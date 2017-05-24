<?php namespace Arcanedev\GeoLocation\Tests\Google\DistanceMatrix;

use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixResponse;
use Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixService;
use Arcanedev\GeoLocation\Tests\TestCase;
use GuzzleHttp\Client;

/**
 * Class     DistanceMatrixServiceTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Google\DistanceMatrix
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DistanceMatrixServiceTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */
    /** @var  \Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixService */
    protected $service;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    protected function setUp()
    {
        parent::setUp();

        $this->service = new DistanceMatrixService(new Client);
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
            \Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixService::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->service);
        }
    }

    /** @test */
    public function it_can_calculate()
    {
        $response = $this->service->calculate(
            $this->getStartPosition(),
            $this->getEndPosition()
        );

        $this->assertInstanceOf(DistanceMatrixResponse::class, $response);
        $this->assertTrue($response->isOk());

        $this->assertSame(
            '17 Hudson River Waterfront Walk, Jersey City, NJ 07305, USA',
            $response->getOriginAddress()
        );

        $this->assertSame(
            'Mount Lee Dr, Los Angeles, CA 90068, USA',
            $response->getDestinationAddress()
        );

        $this->assertSame('4,508 km', $response->distance());
        $this->assertGreaterThanOrEqual(4508227, $response->distance(false));

        $this->assertSame('1 day 17 hours', $response->duration());
        $this->assertGreaterThanOrEqual(146292, $response->duration(false));
    }

    /** @test */
    public function it_can_set_language()
    {
        $this->service->setLanguage('fr');

        $response = $this->service->calculate(
            $this->getStartPosition(),
            $this->getEndPosition()
        );

        $this->assertSame(
            '17 Hudson River Waterfront Walk, Jersey City, NJ 07305, États-Unis',
            $response->getOriginAddress()
        );

        $this->assertSame(
            'Mount Lee Dr, Los Angeles, CA 90068, États-Unis',
            $response->getDestinationAddress()
        );
        $this->assertSame('1 jour 17 heures', $response->duration());
    }

    /** @test */
    public function it_can_set_mode()
    {
        $this->service->setMode('walking');

        $response = $this->service->calculate(
            $this->getStartPosition(),
            $this->getEndPosition()
        );

        $this->assertGreaterThanOrEqual(4454000, $response->distance(false));
        $this->assertGreaterThanOrEqual(3291400, $response->duration(false));
    }

    /**
     * @test
     *
     * @expectedException         \InvalidArgumentException
     * @expectedExceptionMessage  The given mode of transport [teleportation] is invalid. Please check the supported travel modes: https://developers.google.com/maps/documentation/distance-matrix/intro#travel_modes
     */
    public function it_must_throw_exception_on_invalid_mode()
    {
        $this->service->setMode('teleportation');
    }

    /** @test */
    public function it_can_set_units()
    {
        $this->service->setUnits('imperial');

        $response = $this->service->calculate(
            $this->getStartPosition(),
            $this->getEndPosition()
        );

        $this->assertSame('2,801 mi', $response->distance());
    }

    /**
     * @test
     *
     * @expectedException         \InvalidArgumentException
     * @expectedExceptionMessage  The given unit system [cubits] is invalid. Please check the supported units: https://developers.google.com/maps/documentation/distance-matrix/intro#unit_systems
     */
    public function it_must_throw_exception_on_invalid_units()
    {
        $this->service->setUnits('cubits');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    protected function getStartPosition()
    {
        return Position::create(40.689215, -74.044533);
    }

    protected function getEndPosition()
    {
        return Position::create(34.134108, -118.321547);
    }
}
