<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view("admin.auth.login");
    }

    /**
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (
            !Auth::guard("admin")
                ->attempt(
                    $request->only(["email", "password"]),
                    $request->filled("remember")
                )
        ) {
            throw ValidationException::withMessages([
                "email" => "Invalid Email or Password"
            ]);
        }


        return redirect()->intended(route("admin.home"));
    }

    /**
     * @return Redirector|Application|RedirectResponse
     */
    public function destroy(): Redirector|Application|RedirectResponse
    {
        Auth::guard("admin")->logout();
        return redirect(route("admin.login"));
    }
}
