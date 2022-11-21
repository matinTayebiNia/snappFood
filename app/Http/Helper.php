<?php

use Illuminate\Http\JsonResponse;

function throwErrorMessageException($message, $statusCode = 500): JsonResponse
{
    return response()->json($message, $statusCode);
}

function successMessage(mixed $message, int $statusCode = 200): JsonResponse
{
    $message = ["data" => $message, "status" => true];
    return response()->json($message, $statusCode);
}
