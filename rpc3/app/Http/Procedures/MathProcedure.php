<?php

declare(strict_types=1);

namespace App\Http\Procedures;

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
     */
    public function process(Request $request): string
    {
        $sum = array_sum($request->all());
        $result = $sum / count($request->all());

        return json_encode(['average' => $result], JSON_THROW_ON_ERROR);
    }
}
