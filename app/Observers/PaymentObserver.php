<?php

namespace App\Observers;

use App\Enums\Log;
use App\Models\Payment;
use App\Traits\HasLog;

class PaymentObserver
{

    use HasLog;
    public function created(Payment $payment): void
    {
        $this->log($payment, Log::CREATE->value);
    }

    public function deleted(Payment $payment): void
    {
        $this->log($payment, Log::DELETE->value);
    }


    public function updated(Payment $payment)
    {

        $log = $this->log($payment, Log::UPDATE->value);
        $changed = $payment->getChanges();
        $original = $payment->getOriginal();
        $oldValues = array_intersect_key($original, $changed);

        $this->generateLogDetails(json_encode($oldValues), $log->id, json_encode($changed));
    }
}
