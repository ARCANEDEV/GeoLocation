<?php

return [

    /* -----------------------------------------------------------------
     |  Services
     | -----------------------------------------------------------------
     */

    'services' => [

        // GOOGLE
        //-----------------------------------------------------
        'google' => [

            'directions' => [
                'service' => Arcanedev\GeoLocation\Google\Directions\DirectionsService::class,
                'options' => [
                    'key' => env('GOOGLE_MAPS_DIRECTIONS_KEY'),
                ],
            ],

            'distance-matrix' => [
                'service' => Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixService::class,
                'options' => [
                    'key' => env('GOOGLE_MAPS_DISTANCE_MATRIX_KEY'),
                ],
            ],

            'elevation' => [
                'service' => Arcanedev\GeoLocation\Google\Elevation\ElevationService::class,
                'options' => [
                    'key' => env('GOOGLE_MAPS_ELEVATION_KEY'),
                ],
            ],

            'geocoding' => [
                'service' => Arcanedev\GeoLocation\Google\Geocoding\GeocodingService::class,
                'options' => [
                    'key' => env('GOOGLE_MAPS_GEOCODING_KEY'),
                ],
            ],
        ],

    ],

];
