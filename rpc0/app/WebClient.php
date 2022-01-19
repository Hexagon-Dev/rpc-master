<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class WebClient
{
    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getData(array $request)
    {
        $client = new Client();

        $parts = explode(':', $request['method']);

        $request['method'] = $parts[1];

        try {
            $response = $client->post($parts[0] . '_alias/api/v1/endpoint', ['json' => $request]);

            $data = $response->getBody();
            $data = $data->getContents();

            $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        } catch (ClientException $e) {
            $data = response()->json(['error' => $e]);
        }

        return $data;
    }
}
