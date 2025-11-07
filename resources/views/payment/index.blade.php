<x-header />
<x-flash />
<x-payment.filter :clients="$clients" />
<div class="payments-wrap">
    <div class="payments-main">
        <div class="payments-div">
            <a href="{{ url()->previous() ?? route('dashboard') }}">
                <button class="show-table-btn show-table-btn--back">Natrag</button>
            </a>
        </div>
        @if ($contracts->isNotEmpty())
            <div class="payments-div">
                <table class="payments-div__table">
                    <thead>
                        <tr>
                            <th>Ugovor ID</th>
                            <th>Klijent</th>
                            <th>Usluga</th>
                            <th>Plaćanja</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contracts as $contract)
                            <tr>
                                <td>{{ $contract->id }}</td>
                                <td>{{ $contract->client->name }}</td>
                                <td>{{ $contract->service->name }}</td>
                                <td>
                            @php
                                $months = app(\App\Services\PaymentService::class)->generatePaymentMonths($contract, $filters ?? null);
                                $existingMonths = $contract->payments->pluck('month_year')->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y-m'))->toArray();
                            @endphp

                                    @if ($contract->payments->isNotEmpty())
                                        <div class="payments-actions">
                                            @foreach ($contract->payments as $payment)
                                                <div class="payment-div">
                                                    <x-payment.stored-payments :payment="$payment" />
                                                    <x-payment.payment-forms :payment="$payment" />
                                                </div>
                                            @endforeach
                                        </div>

                                        <x-payment.existing-payment :months="$months" :existingMonths="$existingMonths"
                                            :contract="$contract" />
                                    @else
                                        <x-payment.new-payments :months="$months" :contract="$contract" />
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <x-pagination :items="$contracts" />
            </div>
        @else
            <h2 class="fallback-index">Nema zapisa.</h2>
        @endif
    </div>
</div>
