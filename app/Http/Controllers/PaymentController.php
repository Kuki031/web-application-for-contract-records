<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Client;
use App\Services\PaymentService;
use App\Traits\HasDate;
use App\Traits\HasSearchAny;
use App\Traits\HasTable;
use Carbon\Carbon;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    use HasTable, HasDate, HasSearchAny;

    public function __construct(private PaymentService $paymentService) {}

    public function index(Request $request)
    {
        if ($request->has(config('constants.payments_filter_values'))) {
            return $this->paymentService->searchContracts($request);
        }

        $contracts = $this->paymentService->defaultContracts();
        $clients = Client::all();
        return view("payment.index", compact("contracts", "clients") + ['filters' => null]);
    }

    public function filterPayments(Request $request)
    {
        return $this->paymentService->searchContracts($request);
    }



    public function store(StorePaymentRequest $request)
    {
        $existingPayment = $this->paymentService->getExistingPayment($request);

        if ($existingPayment) {
            return back()->with("fail", "Plaćanje već postoji!");
        }

        $formatMonthYear = Carbon::parse($request->month_year)->format("m/Y");
        Payment::create($request->validated());
        return back()->with("success", "Plaćanje za {$formatMonthYear} uspješno poslano.");
    }


    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return back()->with("success", "Plaćanje za {$payment->month_year->format('m/Y')} uspješno ažurirano.");
    }

    public function destroy(Payment $payment, Request $request)
    {
        $payment->delete();
        return back()->with("success", "Plaćanje za {$payment->month_year->format('m/Y')} poništeno.");
    }
}
