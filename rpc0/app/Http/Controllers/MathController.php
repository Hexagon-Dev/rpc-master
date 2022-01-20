<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use JsonException;
use App\WebClient;

class MathController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function process(Request $request)
    {
        $client = new WebClient();

        $processed = [];

        foreach ($request->all() as $data) {
            $result = $client->getData($data);

            $result['method'] = $data['method'];
            $processed[] = $result;
        }

        return json_encode($processed, JSON_THROW_ON_ERROR);
    }
}
