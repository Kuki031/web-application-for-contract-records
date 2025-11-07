<?php

namespace App\Http\Controllers;

use App\Enums\Routes;
use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Client;
use App\Models\Price;
use App\Models\Service;
use App\Models\Template;
use App\Traits\HasDate;
use App\Traits\HasFilterColumns;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Services\ContractService;
use App\Services\HelperService;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{

    use HasSearchAny, HasFilterColumns, HasTable, HasDate;


    public function __construct(private ContractService $contractService, private HelperService $helperService) {}

    public function index(Request $request)
    {
        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::CONTRACT->value,
            thValues: config('constants.contract_index_th_values'),
            itemFields: config('constants.contract_index_td_values')
        );


        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(
                Contract::query(),
                config('constants.contract_select_cols'),
                $request->value,
                Schema::getColumnListing((new Contract())->getTable())
            );
            return view("contract.index",  $indexTableVariables);
        }
        $indexTableVariables["items"] = Contract::select(config('constants.contract_select_cols'))->latest("updated_at")->paginate(10);
        return view("contract.index",  $indexTableVariables);
    }


    public function create()
    {
        $formComponentData = $this->fillFormComponentData(
            route: Routes::CONTRACT->value,
            clients: $this->helperService->getData(Client::class, ["id", "name"]),
            services: $this->helperService->getData(Service::class, ["id", "name"]),
            prices: Price::all(),
            templates: $this->helperService->getData(Template::class, ["id", "name"]),
        );
        return view("contract.create", $formComponentData);
    }

    public function store(StoreContractRequest $request)
    {
        $validate = $request->validated();
        $resources = $this->contractService->fetchAssociatedResources($request);
        $validate['expiration_date'] = $this->contractService->setExpirationDate($request);

        $relativeDocPath = $this->contractService->populateWordDocument(
            $resources["template"],
            $resources["client"],
            $resources["service"],
            $resources["price"],
            $request,
            $validate["expiration_date"]
        );
        $validate["word_link"] = $relativeDocPath;

        Contract::create($validate);
        return to_route("contract.index")->with("success", "Ugovor uspješno kreiran.");
    }


    public function show(Contract $contract)
    {
        $showTableVariables = $this->fillShowTable(
            Routes::CONTRACT->value,
            $contract->load(["client", "service", "price", "user"]),
            config('constants.contract_show_th_values'),
            config('constants.contract_show_td_values'),
        );
        return view("contract.show", $showTableVariables);
    }

    public function edit(Contract $contract)
    {
        $formComponentData = $this->fillFormComponentData(
            Routes::CONTRACT->value,
            $contract,
            $this->helperService->getData(Client::class, ["id", "name"]),
            $this->helperService->getData(Service::class, ["id", "name"]),
            Price::all(),
            $this->helperService->getData(Template::class, ["id", "name"]),
        );
        return view("contract.edit", $formComponentData);
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {

        $validate = $request->validated();
        $resources = $this->contractService->fetchAssociatedResources($request);
        $validate['expiration_date'] = $this->contractService->setExpirationDate($request);

        if (Storage::disk('public')->exists($contract->word_link)) {
            $this->contractService->populateWordDocument(
                $resources["template"],
                $resources["client"],
                $resources["service"],
                $resources["price"],
                $request,
                $validate["expiration_date"],
                basename($contract->word_link)
            );

            $validate["word_link"] = $contract->word_link;
        }
        $contract->update($validate);
        return to_route("contract.index")->with("success", "Ugovor uspješno ažuriran.");
    }


    public function destroy(Contract $contract, Request $request)
    {
        $contract->delete();
        return to_route("contract.index")->with("success", "Ugovor uspješno izbrisan.");
    }


    public function download(Contract $contract)
    {
        $path = storage_path("app/public/{$contract->word_link}");
        $downloadName = basename($path);

        if (!file_exists($path)) {
            return back()->with("fail", "Dokument ne postoji.");
        }

        return response()->download($path, $downloadName);
    }

    public function viewPDF(Contract $contract)
    {
        $path = storage_path("app/public/{$contract->pdf_link}");

        if (!file_exists($path)) {
            return back()->with("fail", "Dokument ne postoji.");
        }

        return response()->file($path);
    }

    public function handlePDF(Request $request, Contract $contract)
    {
        $client = $this->helperService->sanitizeFilename($contract->client->name);
        return $this->contractService->processPdfUpload($request, $contract, $client);
    }
}
