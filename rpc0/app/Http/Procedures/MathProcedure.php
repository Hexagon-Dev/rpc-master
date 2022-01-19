<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\WebClient;
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
        $client = new WebClient();

        $processed = [];

        foreach ($request->all() as $data) {
            $result = $client->getData($data);

            $key = explode(':', $data['method'])[0];
            $processed[$key] = $result['result'];
        }

        return json_encode($processed, JSON_THROW_ON_ERROR);
    }
}
