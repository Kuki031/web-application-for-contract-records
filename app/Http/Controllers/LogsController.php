<?php

namespace App\Http\Controllers;

use App\Enums\Routes;
use App\Models\Log;
use App\Traits\HasFilterColumns;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LogsController extends Controller
{
    use HasTable, HasSearchAny, HasFilterColumns;

    public function index(Request $request)
    {

        $indexTableVariables = $this->fillIndexTableVariables(
            resource: Routes::LOG->value,
            thValues: config('constants.log_index_th_values'),
            itemFields: config('constants.log_index_td_values'),
        );


        if ($request->has("value")) {
            $indexTableVariables["items"] = $this->searchAny(Log::query(), config('constants.log_select_cols'), $request->value, Schema::getColumnListing((new Log())->getTable()));
            return view("log.index",  $indexTableVariables);
        }
        $indexTableVariables["items"] = Log::select(config('constants.log_select_cols'))->latest("updated_at")->paginate(10);
        return view("log.index",  $indexTableVariables);
    }

    public function show(Log $log)
    {
        $showTableVariables = $this->fillShowTable(
            Routes::LOG->value,
            $log->load(["user", "details"]),
            config('constants.log_show_th_values'),
            config('constants.log_show_td_values'),
        );

        return view("log.show", $showTableVariables);
    }
}
