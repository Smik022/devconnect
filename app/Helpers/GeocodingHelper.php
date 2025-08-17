<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class GeocodingHelper
{
    /**
     * Get latitude and longitude for a given address.
     *
     * @param string $address
     * @return array|null
     */
    public static function getCoordinates($address)
    {
        $client = new Client();
        $url = 'https://nominatim.openstreetmap.org/search?q=' . urlencode($address) . '&format=json&addressdetails=1';

        $response = $client->get($url, [
            'headers' => [
                'User-Agent' => 'DevConnectApp/1.0 (your-email@example.com)'  // Add a custom User-Agent header
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        if (isset($data[0])) {
            return [
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon']
            ];
        }
        return null; 
    }

}
