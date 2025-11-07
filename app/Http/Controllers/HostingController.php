<?php

namespace App\Http\Controllers;

use App\Enums\Routes;
use App\Models\Hosting;
use App\Http\Requests\StoreHostingRequest;
use App\Http\Requests\UpdateHostingRequest;
use App\Models\Client;
use App\Services\HelperService;
use App\Services\NoteService;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HostingController extends Controller
{
    use HasTable, HasSearchAny;

    public function __construct(private HelperService $helperService, private NoteService $noteService) {}

    public function index(Request $request)
    {
        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::HOSTING->value,
            thValues: config('constants.hosting_index_th_values'),
            itemFields: config('constants.hosting_index_td_values')
        );


        $query = Hosting::withClientJoin();

        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(
                $query,
                config('constants.hosting_select_cols'),
                $request->value,
                ['hostings.package_name', 'clients.name']
            );
            return view("hosting.index",  $indexTableVariables);
        }

        $indexTableVariables["items"] = $query
            ->select(config('constants.hosting_select_cols'))
            ->latest("hostings.updated_at")
            ->paginate(10);

        return view("hosting.index",  $indexTableVariables);
    }



    public function create()
    {
        $formComponentData = $this->fillFormComponentData(
            route: Routes::HOSTING->value,
            clients: Client::all(['id', 'name'])
        );
        return view("hosting.create", $formComponentData);
    }


    public function store(StoreHostingRequest $request)
    {
        Hosting::create($request->validated());
        return to_route("hosting.index")->with("success", "Hosting uspješno kreiran.");
    }


    public function show(Hosting $hosting)
    {
        $showTableVariables = $this->fillShowTable(
            Routes::HOSTING->value,
            $hosting->load(['client']),
            config('constants.hosting_show_th_values'),
            config('constants.hosting_show_td_values'),
        );
        $notes = $this->noteService->getMorphedNotes($hosting);
        return view("hosting.show", $showTableVariables, ["notes" => $notes]);
    }

    public function edit(Hosting $hosting)
    {
        $formComponentData = $this->fillFormComponentData(
            route: Routes::HOSTING->value,
            item: $hosting,
            clients: Client::all(['id', 'name'])
        );
        return view("hosting.edit", $formComponentData);
    }


    public function update(UpdateHostingRequest $request, Hosting $hosting)
    {
        $hosting->update($request->validated());
        return to_route("hosting.index")->with("success", "Hosting uspješno ažuriran.");
    }


    public function destroy(Hosting $hosting)
    {
        $hosting->delete();
        return to_route("hosting.index")->with("success", "Hosting uspješno izbrisan.");
    }
}
