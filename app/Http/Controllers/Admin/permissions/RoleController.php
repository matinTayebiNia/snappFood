<?php

namespace App\Http\Controllers\Admin\permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\roles\storeRoleRequest;
use App\Http\Requests\Admin\roles\updateRoleRequest;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:show-roles")->only("index");
        $this->middleware("can:create-role")->only(["create", "store"]);
        $this->middleware("can:edit-role")->only(["edit", "update"]);
        $this->middleware("can:destroy-role")->only("destroy");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $roles = Role::query();
        if ($word = request("search")) {
            $roles->where('name', 'LIKE', "%{$word}%")
                ->orWhere("label", "LIKE", "%{$word}%");
        }
        $roles = $roles->latest()->paginate(10);

        return view("admin.roles.all", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("admin.roles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param storeRoleRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(storeRoleRequest $request): Redirector|RedirectResponse|Application
    {
        $role = Role::create([
            "name" => $request->input("name"),
            "label" => $request->input("label"),
        ]);

        $role->permissions()->attach($request->input("permissions"));

        return redirect(route("admin.roles.index"))
            ->with("success", "role created");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|View
     */
    public function edit(Role $role): View|Factory|Application
    {
        return view("admin.roles.edit", compact("role"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param updateRoleRequest $request
     * @param Role $role
     * @return Application|Redirector|RedirectResponse
     */
    public function update(updateRoleRequest $request, Role $role): Redirector|RedirectResponse|Application
    {
        $role->update([
            "name" => $request->input("name"),
            "label" => $request->input("label"),
        ]);

        $role->permissions()->sync($request->input("permissions"));

        return redirect(route("admin.roles.index"))
            ->with("success", "role updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return Application|Redirector|RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role): Redirector|RedirectResponse|Application
    {
        try {
            $role->delete();
            return redirect(route("admin.roles.index"))
                ->with("success", "role deleted");
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
