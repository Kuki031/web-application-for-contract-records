@props(['clients'])

<div class="filter-wrap">
    <form class="filter" action="{{ route('payment.index') }}" method="get">
        <div class="client-input">
            <label for="client_id">Klijent: </label>
            <select name="client_id" id="client">
                <option value="">Odaberi klijenta</option>
                @foreach ($clients as $c)
                    <option value="{{ $c->id }}" {{ request('client_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Od:</label>
            <div class="date-range">
                <input type="month" id="start_picker" value="{{ request('start_year') && request('start_month') ? request('start_year') . '-' . str_pad(request('start_month'), 2, '0', STR_PAD_LEFT) : '' }}">
                <span id="start_picker_label" class="month-label"></span>
                <input type="hidden" name="start_month" id="start_month" value="{{ request('start_month') }}">
                <input type="hidden" name="start_year" id="start_year" value="{{ request('start_year') }}">
            </div>
        </div>

        <div class="form-group">
            <label>Do:</label>
            <div class="date-range">
                <input type="month" id="end_picker" value="{{ request('end_year') && request('end_month') ? request('end_year') . '-' . str_pad(request('end_month'), 2, '0', STR_PAD_LEFT) : '' }}">
                <span id="end_picker_label" class="month-label"></span>
                <input type="hidden" name="end_month" id="end_month" value="{{ request('end_month') }}">
                <input type="hidden" name="end_year" id="end_year" value="{{ request('end_year') }}">
            </div>
        </div>

        <div class="form-group submit-group">
            @php
                $hasFilters = request('client_id') || request('start_month') || request('start_year') || request('end_month') || request('end_year');
            @endphp
            @if ($hasFilters)
                <a href="{{ route('payment.index') }}">
                    <button type="button">Očisti filtere</button>
                </a>
            @else
                <button type="submit">Primjeni filtere</button>
            @endif
        </div>
    </form>
</div>
