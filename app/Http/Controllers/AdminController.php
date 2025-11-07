<?php

namespace App\Http\Controllers;

use App\Enums\Routes;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Models\User;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use HasSearchAny, HasTable;

    public function index(Request $request)
    {

        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::ADMIN->value,
            thValues: config("constants.admin_index_th_values"),
            itemFields: config('constants.admin_index_td_values'),
            showDetails: false,
        );

        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(User::query(), config('constants.admin_select_cols'), $request->value, config('constants.admin_table_cols'));
            return view("admin.index", $indexTableVariables);
        }
        $indexTableVariables["items"] = User::select(config('constants.admin_select_cols'))->where("is_admin", "<>", 1)->latest("updated_at")->paginate(10);
        return view("admin.index", $indexTableVariables);
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        return to_route("admin.index")->with("success", "Korisnik uspješno kreiran.");
    }

    public function create()
    {
        $formComponentData = $this->fillFormComponentData(Routes::ADMIN->value);
        return view("admin.create", $formComponentData);
    }


    public function edit(User $user)
    {
        $formComponentData = $this->fillFormComponentData(Routes::ADMIN->value, $user);
        return view("admin.edit", $formComponentData);
    }

    public function update(UpdateAdminUserRequest $request, User $user)
    {
        $validated = $request->validated();

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return back()->with("success", "Korisnik uspješno ažuriran");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route("admin.index")->with("success", "Korisnik uspješno izbrisan");
    }
}
