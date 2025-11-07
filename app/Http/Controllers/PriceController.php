<?php

namespace App\Http\Controllers;

use App\Enums\Resources;
use App\Enums\Routes;
use App\Models\Price;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    use HasSearchAny, HasTable;

    public function index(Request $request)
    {

        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::PRICE->value,
            thValues: config('constants.price_index_th_values'),
            itemFields: config('constants.price_index_td_values'),
            showDetails: false
        );

        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(Price::query(), config('constants.price_select_cols'), $request->value, config('constants.price_table_cols'));
            return view("price.index", $indexTableVariables);
        }
        $indexTableVariables["items"] = Price::select(config('constants.price_select_cols'))->latest("updated_at")->paginate(10);
        return view("price.index", $indexTableVariables);
    }

    public function create()
    {
        $formComponentData = $this->fillFormComponentData(Routes::PRICE->value);
        return view("price.create", $formComponentData);
    }

    public function store(StorePriceRequest $request)
    {
        Price::create($request->validated());
        return to_route("price.index")->with("success", "Cijena uspješno kreirana.");
    }

    public function edit(Price $price)
    {
        $formComponentData = $this->fillFormComponentData(Routes::PRICE->value, $price);
        return view("price.edit", $formComponentData);
    }


    public function update(UpdatePriceRequest $request, Price $price)
    {
        $price->update($request->validated());
        return to_route("price.index")->with("success", "Cijena uspješno ažurirana.");
    }


    public function destroy(Price $price)
    {
        $price->delete();
        return to_route("price.index")->with("success", "Cijena uspješno izbrisana.");
    }
}
