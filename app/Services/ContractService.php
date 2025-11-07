<?php

namespace App\Services;

use App\Enums\ExpirationType;
use App\Models\Contract;
use App\Models\Client;
use App\Models\Price;
use App\Models\Service;
use App\Models\Template;
use App\Traits\HasDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class ContractService
{
    use HasDate;

    public function __construct(private HelperService $helperService) {}

    public function populateWordDocument(
        Template $template,
        Client $client,
        Service $service,
        Price $price,
        Request $request,
        string $expirationDate,
        ?string $fileName = null
    ): string {
        $templatePath = public_path("templates/{$template->name}.docx");
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('client', "{$client->name}, {$client->address}, {$client->country}, OIB:{$client->oib}, koju zastupa {$client->representer} (u daljnjem tekstu: Naručitelj)");
        $templateProcessor->setValue('create_date', $this->getCreateDateFormattedAttribute($request->signing_date));
        $templateProcessor->setValue('service', "{$service->name} - {$service->description}");
        $templateProcessor->setValue('price', "{$price->price} {$price->currency} + PDV, riječima: {$price->price_words}");
        $templateProcessor->setValue('date', $this->getCreateDateFormattedAttribute($request->starting_date));
        $templateProcessor->setValue('expiration_date', $this->getCreateDateFormattedAttribute($expirationDate));

        if (!$fileName) {
            $fileName = date('d-m-Y_H-i-s') . "_contract_{$this->helperService->sanitizeFilename($client->name)}.docx";
        }

        $clientFolder = $this->helperService->sanitizeFilename($client->name);
        $relativePath = "ugovori/{$clientFolder}/{$fileName}";
        $outputPath = storage_path("app/public/{$relativePath}");

        if (!file_exists(dirname($outputPath))) {
            mkdir(dirname($outputPath), 0775, true);
        }

        $templateProcessor->saveAs($outputPath);
        return $relativePath;
    }



    public function processPdfUpload(Request $request, Contract $contract, string $client)
    {
        if (!$contract) {
            return back()->with("fail", "Ugovor nije pronađen.");
        }

        $request->validate([
            'pdf_link' => 'required|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('pdf_link')) {
            $file = $request->file('pdf_link');

            $clientFolder = $this->helperService->sanitizeFilename($client);
            $filename = date('d-m-Y_H-i-s') . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $relativePath = "ugovori_pdf/{$clientFolder}/{$filename}";

            Storage::disk('public')->putFileAs("ugovori_pdf/{$clientFolder}", $file, $filename);
            $contractTrigger = $this->triggerActiveContract($contract, $relativePath);

            if ($contractTrigger) {
                return back()->with("success", "PDF ugovor uspješno postavljen.");
            }
        }

        return back()->with("fail", "Došlo je do greške prilikom postavljanja PDF ugovora.");
    }


    private function triggerActiveContract(Contract $contract, string $filename)
    {
        return $contract->update([
            "pdf_link" => $filename,
            "is_active" => 1
        ]);
    }

    public function fetchAssociatedResources(Request $request)
    {
        $client = Client::findOrFail($request->client_id);
        $service = Service::findOrFail($request->service_id);
        $price = Price::findOrFail($request->price_id);
        $template = Template::where("name", "=", $request->template_name)->first();

        return [
            "client" => $client,
            "service" => $service,
            "price" => $price,
            "template" => $template
        ];
    }

    public function setExpirationDate(Request $request)
    {
            return match (true) {
            !$request->filled('expiration_date') => Carbon::parse($request->starting_date)->addYear(),
            $request->expiration_date === ExpirationType::FullYear->value => Carbon::parse($request->starting_date)->addYear(),
            $request->expiration_date === ExpirationType::HalfYear->value => Carbon::parse($request->starting_date)->addMonths(6),
            default => Carbon::parse($request->expiration_date),
        };
    }
}

