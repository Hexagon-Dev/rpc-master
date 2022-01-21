<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use Illuminate\Http\Request;
use Sajya\Server\Exceptions\InvalidRequestException;
use Sajya\Server\Exceptions\RuntimeRpcException;
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
     * @return array
     */
    public function average(Request $request): array
    {
        return ['average' => collect($request->all())->avg()];
    }
}
