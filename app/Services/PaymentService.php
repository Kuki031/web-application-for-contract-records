<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Contract;
use App\Models\Payment;
use App\Traits\HasSearchAny;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    use HasSearchAny;

    public function getExistingPayment(Request $request)
    {
        return Payment::where('month_year', $request->month_year)
            ->where('contract_id', $request->contract_id)
            ->first();
    }

    public function searchContracts(Request $request)
    {
        $query = Contract::with(['payments' => function ($q) use ($request) {
            if ($request->start_month && $request->start_year && $request->end_month && $request->end_year) {
                $start = sprintf('%04d-%02d-01', $request->start_year, $request->start_month);
                $end = sprintf('%04d-%02d-01', $request->end_year, $request->end_month);
                $q->whereBetween('month_year', [$start, $end]);
            }
        }, 'service']);

        if ($request->client_id) {
            $query->where('client_id', $request->client_id);
        }

        if (!Auth::user()->is_admin) {
            $query->where(function ($q) {
                $q->where('user_id', Auth::id())
                ->orWhere('is_visible_to_all', 1);
            });
        }

        return view('payment.index', [
        'contracts' => $query->paginate(10),
        'clients' => Client::all(),
        'filters' => [
            'start_year' => $request->start_year,
            'start_month' => $request->start_month,
            'end_year' => $request->end_year,
            'end_month' => $request->end_month,
        ],
    ]);
}

    public function defaultContracts()
    {
        $query = Contract::with(['payments', 'service']);

        if (!Auth::user()->is_admin) {
            $query->where('user_id', Auth::id())
                ->orWhere('is_visible_to_all', 1);
        }

        return $query->paginate(10);
    }

    public function generatePaymentMonths(Contract $contract, ?array $filters = null): array
    {
        $months = [];

        if ($filters && isset($filters['start_month'], $filters['start_year'], $filters['end_month'], $filters['end_year'])) {
            foreach ($contract->payments as $payment) {
                $date = Carbon::parse($payment->month_year);
                $months[] = [
                    'month' => $date->month,
                    'year' => $date->year,
                ];
            }
        } else {
            $now = Carbon::now()->startOfMonth();
            for ($i = 0; $i < 3; $i++) {
                $months[] = [
                    'month' => $now->month,
                    'year' => $now->year,
                ];
                $now->subMonth();
            }
        }

        return $months;
    }
}
