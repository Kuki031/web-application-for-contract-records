<?php

namespace App\Http\Controllers;

use App\Enums\Resources;
use App\Enums\Routes;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use HasSearchAny, HasTable;

    public function index(Request $request)
    {

        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::SERVICE->value,
            thValues: config('constants.service_index_th_values'),
            itemFields: config('constants.service_index_td_values'),
            showDetails: false,
        );

        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(Service::query(), config('constants.service_select_cols'), $request->value, config('constants.service_table_cols'));
            return view("service.index", $indexTableVariables);
        }
        $indexTableVariables["items"] = Service::select(config('constants.service_select_cols'))->latest("updated_at")->paginate(10);
        return view("service.index", $indexTableVariables);
    }

    public function create()
    {
        $formComponentData = $this->fillFormComponentData(Routes::SERVICE->value);
        return view("service.create", $formComponentData);
    }

    public function store(StoreServiceRequest $request)
    {
        Service::create($request->validated());
        return to_route("service.index")->with("success", "Usluga uspješno kreirana.");
    }

    public function edit(Service $service)
    {
        $formComponentData = $this->fillFormComponentData(Routes::SERVICE->value,  $service);
        return view("service.edit", $formComponentData);
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        return to_route("service.index")->with("success", "Usluga uspješno ažurirana.");
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return to_route("service.index")->with("success", "Usluga uspješno izbrisana.");
    }
}
