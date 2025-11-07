@props(['payment'])

<span>Mjesec: {{ \Carbon\Carbon::parse($payment->month_year)->format('m/Y') }}</span>
<span>Poslano: {{ $payment->sent_date->format('d.m.Y.') }}</span>
<span>Poslao/la: <span style="color:rgb(239,64,35);"> {{ $payment->username }}</span></span>
@if ($payment->note)
    <div class="note-wrap">
        <span>Napomena: {{ $payment->note }}</span>
        <form class="payment-note payment-note-update" action="{{ route('payment.update', $payment) }}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="note" value="{{ $payment->note }}">
            <button type="submit">✏️</button>
        </form>
    </div>
@endif
