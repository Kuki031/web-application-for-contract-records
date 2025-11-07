@props(['payment'])

<div>
    <form action="{{ route('payment.destroy', $payment) }}"
        method="post">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="show-table-btn show-table-btn--delete">Poništi</button>
    </form>

    <form class="payment-note payment-note-create"
        action="{{ route('payment.update', $payment) }}"
        method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="note"
            value="{{ $payment->note ? null : null }}">
        <button type="submit"
            class="show-table-btn show-table-btn--update">{{ $payment->note ? 'Napomena-' : 'Napomena+' }}</button>
    </form>
</div>
