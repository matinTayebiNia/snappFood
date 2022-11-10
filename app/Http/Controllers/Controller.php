<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function throwErrorMessageException($message, $statusCode = 500): JsonResponse
    {
        return response()->json($message, $statusCode);
    }

    public function successMessage(mixed $message, int $statusCode = 200): JsonResponse
    {
        $message = ["data" => $message, "status" => true];
        return response()->json($message, $statusCode);
    }

}
