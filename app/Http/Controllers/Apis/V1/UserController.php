<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ApiV1\Auth\UpdateUserInfoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class UserController extends Controller
{
    /**
     * @param UpdateUserInfoRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserInfoRequest $request): JsonResponse
    {
        try {

            auth()->user()->update($request->all());

            return $this->successMessage("your information updated successfully ");

        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }

    }
}
