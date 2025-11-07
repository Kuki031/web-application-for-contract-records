<?php

namespace App\Http\Controllers;

use App\Enums\Routes;
use App\Models\Domain;
use App\Http\Requests\StoreDomainRequest;
use App\Http\Requests\UpdateDomainRequest;
use App\Models\Client;
use App\Services\HelperService;
use App\Services\NoteService;
use App\Traits\HasFilterColumns;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DomainController extends Controller
{
    use HasTable, HasSearchAny, HasFilterColumns;

    public function __construct(private HelperService $helperService, private NoteService $noteService) {}

    public function index(Request $request)
    {
        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::DOMAIN->value,
            thValues: config('constants.domain_index_th_values'),
            itemFields: config('constants.domain_index_td_values')
        );


        $query = Domain::withClientJoin();
        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(
                $query,
                config('constants.domain_select_cols'),
                $request->value,
                ['domains.name', 'clients.name']
            );
            return view("domain.index",  $indexTableVariables);
        }
        $indexTableVariables["items"] = $query
            ->select(config('constants.domain_select_cols'))
            ->latest("domains.updated_at")
            ->paginate(10);
        return view("domain.index",  $indexTableVariables);
    }


    public function create()
    {
        $formComponentData = $this->fillFormComponentData(
            route: Routes::DOMAIN->value,
            clients: $this->helperService->getData(Client::class, ["id", "name"]),
        );
        return view("domain.create", $formComponentData);
    }


    public function store(StoreDomainRequest $request)
    {
        Domain::create($request->validated());
        return to_route("domain.index")->with("success", "Domena uspješno kreirana.");
    }


    public function show(Domain $domain)
    {
        $showTableVariables = $this->fillShowTable(
            Routes::DOMAIN->value,
            $domain->load(['client']),
            config('constants.domain_show_th_values'),
            config('constants.domain_show_td_values'),
        );
        $notes = $this->noteService->getMorphedNotes($domain);
        return view("domain.show", $showTableVariables, ["notes" => $notes]);
    }


    public function edit(Domain $domain)
    {
        $formComponentData = $this->fillFormComponentData(
            route: Routes::DOMAIN->value,
            item: $domain,
            clients: $this->helperService->getData(Client::class, ["id", "name"]),
        );
        return view("domain.edit", $formComponentData);
    }


    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        $domain->update($request->validated());
        return to_route('domain.index')->with("success", "Domena uspješno ažurirana.");
    }


    public function destroy(Domain $domain)
    {
        $domain->delete();
        return to_route('domain.index')->with("success", "Domena uspješno izbrisana.");
    }
}
