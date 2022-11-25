<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\auth\updateOwnerRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        return view('owner.index', compact("unreadNotifications"));
    }


    /**
     * @return Factory|View|Application
     */
    public function edit(): Factory|View|Application
    {
        return view("owner.auth.editProfile");
    }

    /**
     * @param updateOwnerRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function update(updateOwnerRequest $request): Redirector|Application|RedirectResponse
    {

        auth("owner")->user()->update([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "phone" => $request->input("phone"),
            "password" => Hash::make($request->input("password")),
        ]);


        return redirect(route('owner.home'))
            ->with("success", "profile updated");
    }

    public function markNotificationAsRead($id): RedirectResponse
    {
        auth()->user()->unreadNotifications
            ->when($id, function ($query) use ($id) {
                return $query->where("id", $id);
            })
            ->markAsRead();
        return back();
    }

}
