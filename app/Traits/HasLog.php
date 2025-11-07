<?php

namespace App\Traits;

use App\Models\Log;
use App\Models\LogDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait HasLog
{
    protected function log($model, string $action)
    {
        $ip = app()->runningInConsole() ? 'console' : request()->ip();

        return Log::create([
            'user_id' => Auth::id(),
            'resource_id' => $model->id,
            'table' => $model->getTable(),
            'action' => $action,
            'ip_address' => $ip,
        ]);
    }

    protected function generateLogDetails($oldValues, $logId, $changes)
    {
        LogDetails::create([
            "old_values" => $oldValues,
            "new_values" => $changes,
            "log_id" => $logId,
            "user_id" => Auth::id()
        ]);
    }
}
