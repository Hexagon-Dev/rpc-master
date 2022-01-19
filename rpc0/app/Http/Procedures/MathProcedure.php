<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Sajya\Server\Procedure;

class MathProcedure extends Procedure
{
    /**
     * @var string
     */
    public static string $name = 'math';

    /**
     * @param Request $request
     *
     * @return string
     * @throws \JsonException
     * @throws GuzzleException
     */
    public function process(Request $request): string
    {
        $processed = [];

        foreach ($request->all() as $url => $params) {
            $result = json_decode($this->getData($url . '/api/v1/endpoint', $params)['result'], true, 512, JSON_THROW_ON_ERROR);
            $key = key($result);
            $processed[$key] = $result[$key];
        }

        return json_encode($processed, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    private function getData(string $url, array $params)
    {
        $client = new Client();

        $json = [
            'json' => [
                'jsonrpc' => '2.0',
                'method' => 'math@process',
                'params' => $params,
                'id' => 1,
            ]
        ];

        try {
            $response = $client->post($url, $json);

            $data = $response->getBody();
            $data = $data->getContents();
            $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        } catch (ClientException $e) {
            $data = response()->json(['error' => $e]);
        }

        return $data;
    }
}
