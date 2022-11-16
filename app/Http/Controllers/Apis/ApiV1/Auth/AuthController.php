<?php

namespace App\Http\Controllers\Apis\ApiV1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ApiV1\Auth\LoginRequest;
use App\Http\Requests\Apis\ApiV1\Auth\ResendCodeRequest;
use App\Http\Requests\Apis\ApiV1\Auth\VerifyCodeRequest;
use App\Models\ActiveCode;
use App\Models\User;
use Ghasedak\GhasedakApi;
use Illuminate\Http\JsonResponse;
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
            $user = User::wherePhone($request->input("phone"))->first();
            if (!$user) {
                $user = User::create([
                    "phone" => $request->input("phone"),
                ]);
            }
            $code = ActiveCode::generateCode($user);

            //todo send sms

             /*$api = new GhasedakApi(env("GHSEDAK_API_KEY"));
             $api->SendSimple($user->phone, "codeTest:{$code}");*/

            return $this->successMessage( "sms successfully  sent",201);

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
            $user = User::wherePhone($request->input("phone"))->first();
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
            $token = $user->createToken(env("APP_KEY_TOKEN"))->plainTextToken;

            return $this->successMessage(["token" => $token]);

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
    public function resendCode(ResendCodeRequest $request): JsonResponse
    {
        try {
            $user = User::wherePhone($request->input("phone"))->first();

            if (!$user)
                throw ValidationException::withMessages([
                    "phone" => ["phone number not found please inter your phone number in login api
                     and ask to resend code !"]
                ]);


            $phone = $user->phone;
            $code = ActiveCode::generateCode($user);

            //todo send sms

            /* $api = new GhasedakApi(env("GHSEDAK_API_KEY"));
             $api->SendSimple($phone, "codeTest:{$code}");*/

            return $this->successMessage(" sms successfully sent again");

        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }

    }
}
