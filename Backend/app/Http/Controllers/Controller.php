<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected function jsonResponse(string $message, $data = null, int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
