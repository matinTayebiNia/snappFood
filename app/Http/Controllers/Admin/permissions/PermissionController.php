<?php

namespace App\Http\Controllers\Admin\permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\permissions\storePermissionRequest;
use App\Http\Requests\Admin\permissions\updatePermissionRequest;
use App\Models\Permission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:show-permissions")->only("index");
        $this->middleware("can:create-permission")->only(["create", "store"]);
        $this->middleware("can:edit-permission")->only(["edit", "update"]);
        $this->middleware("can:destroy-permission")->only("destroy");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $permissions = Permission::query();
        if ($word = request("search")) {
            $permissions->where('name', 'LIKE', "%{$word}%")
                ->orWhere("label", "LIKE", "%{$word}%");
        }
        $permissions = $permissions->latest()->paginate(10);

        return view("admin.permissions.all", compact("permissions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("admin.permissions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(storePermissionRequest $request)
    {
        Permission::create([
            "name" => $request->input("name"),
            "label" => $request->input("label")
        ]);

        return redirect(route("admin.permissions.index"))
            ->with("success", "permission created");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return Application|Factory|View
     */
    public function edit(Permission $permission): View|Factory|Application
    {
        return view("admin.permissions.edit", compact("permission"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param updatePermissionRequest $request
     * @param Permission $permission
     * @return Application|RedirectResponse|Redirector
     */
    public function update(updatePermissionRequest $request, Permission $permission): Redirector|RedirectResponse|Application
    {
        $permission->update([
            "name" => $request->input("name"),
            "label" => $request->input("label")
        ]);

        return redirect(route("admin.permissions.index"))
            ->with("success", "permission created");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return Application|Redirector|RedirectResponse
     * @throws \Exception
     */
    public function destroy(Permission $permission): Redirector|RedirectResponse|Application
    {
        try {
            $permission->delete();
            return redirect(route("admin.permissions.index"))
                ->with("success", "permission deleted");
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
