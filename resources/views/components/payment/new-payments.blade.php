@props(['contract', 'months'])

<div class="payments-actions">
    @foreach ($months as $month)
        <form action="{{ route('payment.store') }}" method="post">
            @csrf
            <input type="hidden" name="client_id" value="{{ $contract->client_id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="month_year" value="{{ sprintf('%04d-%02d-01', $month['year'], $month['month']) }}">
            <input type="hidden" name="contract_id" value="{{ $contract->id }}">
            <input type="hidden" name="status" value="sent">
            <input type="hidden" name="sent_date" value="{{ date('Y-m-d') }}">
            <button class="date-btn" type="submit">{{ $month['month'] }}/{{ $month['year'] }}</button>
        </form>
    @endforeach
</div>
