<?php namespace Arcanedev\GeoLocation\Tests\Entities\Measures;

use Arcanedev\GeoLocation\Entities\Measures\Distance;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     DistanceTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities\Measures
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DistanceTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $distance = new Distance('1 km', 1000);

        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Entities\Measures\Distance::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $distance);
        }
    }

    /** @test */
    public function it_can_make()
    {
        $distance = Distance::make('1 km', 1000);

        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Entities\Measures\Distance::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $distance);
        }
    }

    /** @test */
    public function it_can_make_from_array()
    {
        $distance = Distance::makeFromArray(['text' => '1 km', 'value' => 1000]);

        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Entities\Measures\Distance::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $distance);
        }
    }

    /** @test */
    public function it_can_get_value_or_text()
    {
        $distance = Distance::make('1 km', 1000);

        static::assertSame(1000, $distance->value());
        static::assertSame(1000, $distance->getValue());

        static::assertSame('1 km', $distance->text());
        static::assertSame('1 km', $distance->getText());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $distance = Distance::make('1 km', 1000);

        static::assertSame(['text' => '1 km', 'value' => 1000], $distance->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $distance = Distance::makeFromArray(
            $data = ['text' => '1 km', 'value' => 1000]
        );

        $expected = json_encode($data);

        static::assertSame($expected, $distance->toJson());
        static::assertSame($expected, json_encode($distance));
    }
}
