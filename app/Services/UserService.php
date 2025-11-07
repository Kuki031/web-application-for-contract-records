<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Price;
use App\Models\Service;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function __construct(private HelperService $helperService) {}
    public function updatePassword(Request $request)
    {

        $request->validated();

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->with("fail", "Neispravna stara lozinka.");
        }

        $password = Hash::make($request->password_new);
        User::find(Auth::id())->update([
            "password" => $password
        ]);

        return back()->with("success", "Lozinka uspješno ažurirana");
    }

    private function prepareDashboard(string $model, string $builder, array $columns, string $name)
    {
        $items = (new $builder)->query()->select($columns)->limit(3)->get();
        $count = (new $builder)->query()->count();

        return [
            "name" => $name,
            "route" => "{$model}.index",
            "first_three" => $items,
            "count" => $count
        ];
    }

    public function populateDashboard()
    {
        $names = config('constants.dashboard_th_values');
        $columns = [
            config('constants.dashboard_template_td_values'),
            config('constants.dashboard_client_td_values'),
            config('constants.dashboard_service_td_values'),
            config('constants.dashboard_price_td_values'),
        ];
        $result = [];
        $resources = config('constants.dashboard_models');
        $builders = [Template::class, Client::class, Service::class, Price::class];

        for ($i = 0; $i < sizeof($names); $i++) {
            $item = $this->prepareDashboard($resources[$i], $builders[$i], $columns[$i], $names[$i]);
            $result[] = $item;
        }

        return $result;
    }
}
