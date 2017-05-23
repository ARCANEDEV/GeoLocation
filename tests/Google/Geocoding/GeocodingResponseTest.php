<?php namespace Arcanedev\GeoLocation\Tests\Google\Geocoding;

use Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     GeocodingResponseTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Google\Geocoding
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeocodingResponseTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse */
    protected $response;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp()
    {
        parent::setUp();

        $this->response = new GeocodingResponse(
            $this->getServiceResponse()
        );
    }

    protected function tearDown()
    {
        unset($this->response);

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
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->response);
        }
    }

    /** @test */
    public function it_can_get_raw_data()
    {
        $this->assertSame($this->getServiceResponse(), $this->response->getRaw());
    }

    /** @test */
    public function it_can_check_if_response_is_ok()
    {
        $this->assertTrue($this->response->isOk());

        $this->response = new GeocodingResponse([]);

        $this->assertFalse($this->response->isOk());
    }

    /** @test */
    public function it_can_get_formatted_address()
    {
        $this->assertSame(
            '5 Avenue Anatole France, 75007 Paris, France',
            $this->response->getFormattedAddress()
        );
    }

    /** @test */
    public function it_can_get_address_components()
    {
        $expected = [
            [
                'long_name'  => '5',
                'short_name' => '5',
                'types'      => ['street_number'],
            ],
            [
                'long_name'  => 'Avenue Anatole France',
                'short_name' => 'Avenue Anatole France',
                'types'      => ['route'],
            ],
            [
                'long_name'  => 'Paris',
                'short_name' => 'Paris',
                'types'      => ['locality', 'political'],
            ],
            [
                'long_name'  => 'Paris',
                'short_name' => 'Paris',
                'types'      => ['administrative_area_level_2', 'political']
            ],
            [
                'long_name'  => 'Île-de-France',
                'short_name' => 'Île-de-France',
                'types'      => ['administrative_area_level_1', 'political'],
            ],
            [
                'long_name'  => 'France',
                'short_name' => 'FR',
                'types'      => ['country', 'political']
            ],
            [
                'long_name'  => '75007',
                'short_name' => '75007',
                'types'      => ['postal_code']
            ],
        ];

        $this->assertSame($expected, $this->response->getAddressComponents());
    }
    /** @test */
    public function it_can_get_location_position()
    {
        $position = $this->response->getLocationPosition();

        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Position::class, $position);

        $this->assertCoordinateInstance($position->lat());
        $this->assertCoordinateInstance($position->long());

        $this->assertSame(48.8588871, $position->lat()->value());
        $this->assertSame(2.2944861, $position->long()->value());
    }

    /** @test */
    public function it_can_get_location_type()
    {
        $this->assertSame('ROOFTOP', $this->response->getLocationType());
    }

    /** @test */
    public function it_can_get_viewport()
    {
        $viewport = $this->response->getViewport();
        $expected = [
            'northeast' => [
                'latitude'  => 48.860236080292,
                'longitude' => 2.2958350802915,
            ],
            'southwest' => [
                'latitude'  => 48.857538119709,
                'longitude' => 2.2931371197085,
            ],
        ];

        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Viewport::class, $viewport);
        $this->assertSame($expected, $viewport->toArray());

        $this->assertSame($expected['northeast']['latitude'],  $viewport->getNorthEast()->lat()->value());
        $this->assertSame($expected['northeast']['longitude'], $viewport->getNorthEast()->long()->value());

        $this->assertSame($expected['southwest']['latitude'],  $viewport->getSouthWest()->lat()->value());
        $this->assertSame($expected['southwest']['longitude'], $viewport->getSouthWest()->long()->value());
    }

    /** @test */
    public function it_can_get_place_id()
    {
        $this->assertSame('ChIJuX7JjuFv5kcRbLER0b_rtC4', $this->response->getPlaceId());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $expected = $this->expectedArray();

        $this->assertSame($expected, $this->response->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $json = json_encode($this->response);

        $this->assertJson($json);
        $this->assertSame(json_encode($this->expectedArray()), $json);

        $json = $this->response->toJson();

        $this->assertJson($json);
        $this->assertSame(json_encode($this->expectedArray()), $json);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    protected function getServiceResponse()
    {
        return [
            'results' => [
                [
                    'address_components' => [
                        [
                            'long_name'  => '5',
                            'short_name' => '5',
                            'types'      => ['street_number'],
                        ],
                        [
                            'long_name'  => 'Avenue Anatole France',
                            'short_name' => 'Avenue Anatole France',
                            'types'      => ['route'],
                        ],
                        [
                            'long_name'  => 'Paris',
                            'short_name' => 'Paris',
                            'types'      => ['locality', 'political'],
                        ],
                        [
                            'long_name'  => 'Paris',
                            'short_name' => 'Paris',
                            'types'      => ['administrative_area_level_2', 'political']
                        ],
                        [
                            'long_name'  => 'Île-de-France',
                            'short_name' => 'Île-de-France',
                            'types'      => ['administrative_area_level_1', 'political'],
                        ],
                        [
                            'long_name'  => 'France',
                            'short_name' => 'FR',
                            'types'      => ['country', 'political']
                        ],
                        [
                            'long_name'  => '75007',
                            'short_name' => '75007',
                            'types'      => ['postal_code']
                        ],
                    ],
                    'formatted_address'  => '5 Avenue Anatole France, 75007 Paris, France',
                    'geometry'           => [
                        'location'      => [
                            'lat' => 48.8588871,
                            'lng' => 2.2944861,
                        ],
                        'location_type' => 'ROOFTOP',
                        'viewport'      => [
                            'northeast' => [
                                'lat' => 48.860236080292,
                                'lng' => 2.2958350802915,
                            ],
                            'southwest' => [
                                'lat' => 48.857538119709,
                                'lng' => 2.2931371197085,
                            ],
                        ],
                    ],
                    'partial_match'      => true,
                    'place_id'           => 'ChIJuX7JjuFv5kcRbLER0b_rtC4',
                    'types'              => ['street_address'],
                ],
            ],
            'status'  => 'OK'
        ];
    }

    private function expectedArray()
    {
        return [
            "formatted_address" => "5 Avenue Anatole France, 75007 Paris, France",
            "address_components" => [
                [
                    'long_name'  => '5',
                    'short_name' => '5',
                    'types'      => ['street_number'],
                ],
                [
                    'long_name'  => 'Avenue Anatole France',
                    'short_name' => 'Avenue Anatole France',
                    'types'      => ['route'],
                ],
                [
                    'long_name'  => 'Paris',
                    'short_name' => 'Paris',
                    'types'      => ['locality', 'political'],
                ],
                [
                    'long_name'  => 'Paris',
                    'short_name' => 'Paris',
                    'types'      => ['administrative_area_level_2', 'political']
                ],
                [
                    'long_name'  => 'Île-de-France',
                    'short_name' => 'Île-de-France',
                    'types'      => ['administrative_area_level_1', 'political'],
                ],
                [
                    'long_name'  => 'France',
                    'short_name' => 'FR',
                    'types'      => ['country', 'political']
                ],
                [
                    'long_name'  => '75007',
                    'short_name' => '75007',
                    'types'      => ['postal_code']
                ],
            ],
            "location_position" => [
                "latitude" => 48.8588871,
                "longitude" => 2.2944861,
            ],
            "location_type" => "ROOFTOP",
            "viewport" => [
                "northeast" => [
                    "latitude" => 48.860236080292,
                    "longitude" => 2.2958350802915,
                ],
                "southwest" => [
                    "latitude" => 48.857538119709,
                    "longitude" => 2.2931371197085,
                ],
            ],
            "place_id" => "ChIJuX7JjuFv5kcRbLER0b_rtC4",
        ];
    }
}
