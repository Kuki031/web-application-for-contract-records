<?php

namespace App\Observers;

use App\Enums\Log;
use App\Models\Contract;
use App\Traits\HasLog;

class ContractObserver
{
    use HasLog;

    public function created(Contract $contract)
    {
        $this->log($contract, Log::CREATE->value);
    }

    public function updated(Contract $contract)
    {
        $log = $this->log($contract, Log::UPDATE->value);

        $changed = $contract->getChanges();
        $original = $contract->getOriginal();
        $oldValues = array_intersect_key($original, $changed);

        $this->generateLogDetails(json_encode($oldValues), $log->id, json_encode($changed));
    }

    public function deleted(Contract $contract)
    {
        $this->log($contract, Log::DELETE->value);
    }
}
