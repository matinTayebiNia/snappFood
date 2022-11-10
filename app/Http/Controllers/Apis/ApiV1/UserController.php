<?php

namespace App\Http\Controllers\Apis\ApiV1;

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

            return $this->successMessage([
                "msg" => "your information updated successfully ",
                "status" => true
            ]);

        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }

    }
}
