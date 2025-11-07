<?php

namespace App\Listeners;

use App\Events\ContractDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class DeleteContractFiles
{

    public function __construct()
    {
        //
    }

    public function handle(ContractDeleted $event)
    {
        $contract = $event->contract;

        if ($contract->word_link) {
            $wordPath = $contract->word_link;
            if (Storage::disk('public')->exists($wordPath)) {
                Storage::disk('public')->delete($wordPath);

                $wordDir = dirname(Storage::disk('public')->path($wordPath));
                if (is_dir($wordDir) && count(glob($wordDir . '/*')) === 0) {
                    @rmdir($wordDir);
                }
            }
        }

        if ($contract->pdf_link) {
            $pdfPath = $contract->pdf_link;
            if (Storage::disk('public')->exists($pdfPath)) {
                Storage::disk('public')->delete($pdfPath);

                $pdfDir = dirname(Storage::disk('public')->path($pdfPath));
                if (is_dir($pdfDir) && count(glob($pdfDir . '/*')) === 0) {
                    @rmdir($pdfDir);
                }
            }
        }
    }
}
