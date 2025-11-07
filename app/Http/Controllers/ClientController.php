<?php

namespace App\Http\Controllers;

use App\Enums\Resources;
use App\Enums\Routes;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Traits\HasFilterColumns;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    use HasSearchAny, HasFilterColumns, HasTable;

    public function index(Request $request)
    {

        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::CLIENT->value,
            thValues: config('constants.client_index_th_values'),
            itemFields: config('constants.client_index_td_values')
        );


        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(
                Client::query(),
                config('constants.client_select_cols'),
                $request->value,
                Schema::getColumnListing((new Client())->getTable())
            );
            return view("client.index",  $indexTableVariables);
        }
        $indexTableVariables["items"] = Client::select(config('constants.client_select_cols'))->latest("updated_at")->paginate(10);
        return view("client.index",  $indexTableVariables);
    }

    public function create()
    {
        $formComponentData = $this->fillFormComponentData(Routes::CLIENT->value);
        return view("client.create", $formComponentData);
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());
        return to_route("client.index")->with("success", "Klijent uspješno kreiran.");
    }

    public function show(Client $client)
    {
        $showTableVariables = $this->fillShowTable(
            Routes::CLIENT->value,
            $client,
            config('constants.client_show_th_values'),
            $this->filter($client, ['created_at', 'updated_at']),
        );
        return view("client.show", $showTableVariables);
    }

    public function edit(Client $client)
    {
        $formComponentData = $this->fillFormComponentData(Routes::CLIENT->value, $client);
        return view("client.edit", $formComponentData);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return to_route("client.index")->with("success", "Klijent uspješno ažuriran");
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return to_route("client.index")->with("success", "Klijent uspješno izbrisan");
    }

    public function getClientDomains(Client $client)
    {
        return view('client.client_domains', compact("client"));
    }
}
