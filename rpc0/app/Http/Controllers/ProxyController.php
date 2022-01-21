<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\WebClient;
use InvalidArgumentException;
use Sajya\Server\Http\Parser;
use Sajya\Server\Http\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;
use Throwable;

class ProxyController extends Controller
{
    public const SEPARATOR = '|';

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function process(Request $request): JsonResponse
    {
        $client = new WebClient();
        $parser = new Parser($request->getContent());

        $processed = [];

        try {
            foreach ($parser->makeRequests() as $rpcRequest) {
                if (!str_contains($rpcRequest->getMethod(), self::SEPARATOR)) {
                    throw new InvalidArgumentException('Each method requires 3-rd party URL');
                }
                $parts = explode(self::SEPARATOR, $rpcRequest->getMethod());
                $rpcRequest->setMethod($parts[1]);
                $processed[] = Response::makeFromResult($client->getData($rpcRequest, $parts[0]), $rpcRequest);
            }
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], StatusResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json($processed);
    }
}
