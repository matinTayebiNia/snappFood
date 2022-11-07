<?php

namespace App\Http\Controllers\Apis\ApiV1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ApiV1\Auth\LoginRequest;
use App\Http\Requests\Apis\ApiV1\Auth\ResendCodeRequest;
use App\Http\Requests\Apis\ApiV1\Auth\UpdateUserInfoRequest;
use App\Http\Requests\Apis\ApiV1\Auth\VerifyCodeRequest;
use App\Models\ActiveCode;
use App\Models\User;
use Ghasedak\GhasedakApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PHPUnit\Exception;

class AuthController extends Controller
{


    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {

        try {
            $user = User::where("phone", $request->input("phone"))->first();
            if (!$user) {
                $user = User::create([
                    "phone" => $request->input("phone"),
                ]);
            }
            $code = ActiveCode::generateCode($user);

            $api = new GhasedakApi(env("GHSEDAK_API_KEY"));
            $api->SendSimple($user->phone, "codeTest:{$code}");

            return $this->successMessage([
                "message" => "sms successfully  sent",
                "status" => true
            ]);

        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    /**
     * @throws ValidationException
     */
    public function verifyCode(VerifyCodeRequest $request): JsonResponse
    {
        try {
            //finding User with phone number
            $user = User::findOrFail($request->input("phone"));

            // verifying  code
            $status = ActiveCode::verifyCode($request->input("token"), $user);

            // checking code is invalid
            if (!$status) {
                // throw validation exception
                throw ValidationException::withMessages([
                    'token' => ['the token is invalid.'],
                ]);
            }

            //create token and send for user
            $token = $user->createToken($request->input("email"))->plainTextToken;

            return $this->successMessage([
                "token" => $token,
                "status" => true
            ]);

        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    public function resendCode(ResendCodeRequest $request)
    {
        try {
            $user = User::findOrFail($request->input("phone"));

            $phone = $user->phone_number;
            $code = ActiveCode::generateCode($user);

            $api = new GhasedakApi(env("GHSEDAK_API_KEY"));
            $api->SendSimple($phone, "codeTest:{$code}");

            return $this->successMessage([
                "msg" => " sms  successfully sent again",
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
