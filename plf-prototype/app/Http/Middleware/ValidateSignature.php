<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as Middleware;

class ValidateSignature extends Middleware
{
    /**
     * The names of the query strings that should be ignored.
     *
     * @var array<int, string>
     */
    protected $ignore = [
        // 'fbclid',
        // 'utm_source',
    ];
}