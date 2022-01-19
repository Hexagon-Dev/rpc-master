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
        return json_encode(['multiply' => array_product($request->all())], JSON_THROW_ON_ERROR);
    }
}
