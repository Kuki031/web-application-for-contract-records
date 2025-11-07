<?php

namespace App\Http\Controllers;

use App\Enums\Resources;
use App\Enums\Routes;
use App\Models\Template;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    use HasSearchAny, HasTable;

    public function index(Request $request)
    {

        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::TEMPLATE->value,
            thValues: config('constants.template_index_th_values'),
            itemFields: config('constants.template_index_td_values'),
            showDetails: false,
        );

        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(Template::query(), config('constants.template_select_cols'), $request->value, config('constants.template_table_cols'));
            return view("template.index", $indexTableVariables);
        }
        $indexTableVariables["items"] = Template::select(config('constants.template_select_cols'))->latest("updated_at")->paginate(10);
        return view("template.index", $indexTableVariables);
    }


    public function create()
    {
        $formComponentData = $this->fillFormComponentData(Routes::TEMPLATE->value);
        return view("template.create", $formComponentData);
    }


    public function store(StoreTemplateRequest $request)
    {
        Template::create($request->validated());
        return to_route("template.index")->with("success", "Predložak uspješno kreiran.");
    }

    public function edit(Template $template)
    {
        $formComponentData = $this->fillFormComponentData(Routes::TEMPLATE->value, $template);
        return view("template.edit", $formComponentData);
    }

    public function update(UpdateTemplateRequest $request, Template $template)
    {
        $template->update($request->validated());
        return to_route("template.index")->with("success", "Predložak uspješno ažuriran");
    }

    public function destroy(Template $template)
    {
        $template->delete();
        return to_route("template.index")->with("success", "Predložak uspješno izbrisan.");
    }
}
