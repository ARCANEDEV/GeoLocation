<?php namespace Arcanedev\GeoLocation\Tests\Google\Directions;

use Arcanedev\GeoLocation\Google\Directions\DirectionsResponse;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     DirectionsResponseTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Google\Directions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DirectionsResponseTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $response = new DirectionsResponse;
        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Google\AbstractResponse::class,
            \Arcanedev\GeoLocation\Google\Directions\DirectionsResponse::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $response);
        }

        $this->assertFalse($response->isOk());
    }

    /** @test */
    public function it_can_get_data()
    {
        $response = $this->createResponse();

        $this->assertTrue($response->isOk());

        $this->assertCount(1, $response->getRoutes());

        /** @var \Arcanedev\GeoLocation\Google\Directions\Entities\Route $route */
        $route = $response->getRoutes()->first();

        $this->assertSame('A6 and A7', $route->summary());
        $this->assertSame('Map data ©2017 Google', $route->copyrights());
        $this->assertInstanceOf(
            \Arcanedev\GeoLocation\Entities\Coordinates\Viewport::class,
            $route->bounds()
        );

        $legs = $route->legs();

        $this->assertCount(1, $legs);

        /** @var  \Arcanedev\GeoLocation\Google\Directions\Entities\Leg  $leg */
        $leg = $legs->first();

        $this->assertSame('Paris, France', $leg->startAddress());
        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Position::class, $leg->startLocation());

        $this->assertSame('Marseille, France', $leg->endAddress());
        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Position::class, $leg->endLocation());

        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Measures\Distance::class, $leg->distance());
        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Measures\Duration::class, $leg->duration());
        $this->assertSame([], $leg->trafficSpeedEntry());
        $this->assertSame([], $leg->viaWaypoint());

        $steps = $leg->steps();

        $this->assertCount(39, $steps);

        /** @var  \Arcanedev\GeoLocation\Google\Directions\Entities\Step  $step */
        $step = $steps->first();

        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Position::class, $step->start());
        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Position::class, $step->end());
        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Measures\Distance::class, $step->distance());
        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Measures\Duration::class, $step->duration());
        $this->assertSame('DRIVING', $step->mode());
        $this->assertSame(
            'Head <b>west</b> on <b>Rue de Rivoli</b> toward <b>Quai de l\'Hôtel de ville</b>',
            $step->instructions()
        );
        $this->assertSame(["points" => "cmeiHmmjMCPGt@Kr@O|@Mh@"], $step->polyline());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $response = $this->createResponse();

        $this->assertArrayHasKey('geocoded_waypoints', $response->toArray());
        $this->assertArrayHasKey('routes', $response->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $response = $this->createResponse();

        $this->assertJson($response->toJson());
        $this->assertJson(json_encode($response));
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create the directions response.
     *
     * @return \Arcanedev\GeoLocation\Google\Directions\DirectionsResponse
     */
    private function createResponse()
    {
        return new DirectionsResponse(
            $this->getFixtureResponseData()
        );
    }

    /**
     * Get the json response (fixture).
     *
     * @param  string  $filename
     *
     * @return array
     */
    protected function getFixtureResponseData($filename = 'paris-to-marseille-directions')
    {
        $path = $this->getFixturePath() . "/google/directions/{$filename}.json";

        return json_decode(file_get_contents($path), true);
    }
}
