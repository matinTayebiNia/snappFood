<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    /**showing
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view("owner.auth.login");
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (
            !Auth::guard("owner")
                ->attempt(
                    $request->only(["email", "password"]),
                    $request->filled("remember")
                )
        ) {
            throw ValidationException::withMessages([
                "email" => "Invalid Email or Password"
            ]);
        }


        return redirect()->intended(route("owner.home"));
    }

    public function destroy(): RedirectResponse
    {
        Auth::guard("owner")->logout();
        return redirect()->intended(route("owner.login"));
    }
}
