<?php

namespace App;

use GuzzleHttp\Client;
use Sajya\Server\Exceptions\InvalidRequestException;
use Sajya\Server\Http\Request;
use Throwable;

class WebClient
{
    /**
     * @param Request $request
     * @param string $url
     * @return mixed
     */
    public function getData(Request $request, string $url)
    {
        $client = new Client();

        try {
            $response = $client->post($url, ['json' => $request->jsonSerialize()]);

            $data = $response->getBody();
            $data = $data->getContents();

            $result = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

            if ($error = data_get($result, 'error')) {
                return new InvalidRequestException($error);
            }

            return data_get($result, 'result');

        } catch (Throwable $e) {
            return new InvalidRequestException(['error' => $e->getMessage()]);
        }
    }
}
