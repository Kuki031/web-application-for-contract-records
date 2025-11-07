@csrf

@if (isset($item))
    @method('PUT')
@endif


<div class="client-input">
    <label for="client_id">Klijent: </label>
    <select name="client_id" id="client">
        <option value="">Odaberi klijenta</option>
        @foreach ($clients as $c)
            <option value="{{ $c->id }}"
                {{ old('client_id', $item->client_id ?? '') == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select>
    @error('client_id')
        <span>{{ $message }}</span>
    @enderror
</div>



<div>
    <label for="starting_date">Datum početka usluge: </label>
    <input type="date" name="starting_date"
        value="{{ old('starting_date') ?? ($item?->starting_date?->format('Y-m-d') ?? '') }}">
    @error('starting_date')
        <span>{{ $message }}</span>
    @enderror
</div>


@php
    $startingDate = $item?->starting_date ? \Carbon\Carbon::parse($item?->starting_date) : now();
    $halfYearDate = $startingDate->copy()->addMonths(6)->format('Y-m-d');
    $fullYearDate = $startingDate->copy()->addYear()->format('Y-m-d');
    $selectedDate = old('expiration_date', optional($item?->expiration_date)->format('Y-m-d'));
@endphp

<div>
    <label for="expiration_date">Vrijeme trajanja usluge:</label>
    <select name="expiration_date" id="expiration_date">
        <option value="">Odaberi vrijeme trajanja usluge</option>

        @foreach (\App\Enums\ExpirationType::options() as $type)
            <option value="{{ $type->value }}"
                {{ $selectedDate === ($type === \App\Enums\ExpirationType::HalfYear ? $halfYearDate : $fullYearDate) ? 'selected' : '' }}>
                {{ $type->label() }}
            </option>
        @endforeach

        @if ($selectedDate !== $halfYearDate && $selectedDate !== $fullYearDate && $selectedDate)
            <option value="{{ $selectedDate }}" selected>{{ \Carbon\Carbon::parse($selectedDate)->format('d.m.Y') }}</option>
        @endif
    </select>

    @error('expiration_date')
        <span>{{ $message }}</span>
    @enderror
</div>





<div>
    <label for="template_name">Predložak: </label>
    <select name="template_name">
        <option value="">Odaberi predložak</option>
        @foreach ($templates as $t)
            <option value="{{ $t->name }}"
                {{ old('template_name', $item->template_name ?? '') == $t->name ? 'selected' : '' }}>
                {{ $t->name }}
            </option>
        @endforeach
    </select>
    @error('template_name')
        <span>{{ $message }}</span>
    @enderror
</div>



<div>
    <label for="price_id">Cijena: </label>
    <select name="price_id">
        <option value="">Odaberi cijenu</option>
        @foreach ($prices as $p)
            <option value="{{ $p->id }}"
                {{ old('price_id', $item?->price_id ?? '') == $p->id ? 'selected' : '' }}>
                {{ "{$p->price} {$p->currency} + PDV, riječima: {$p->price_words}" }}
            </option>
        @endforeach
    </select>
    @error('price_id')
        <span>{{ $message }}</span>
    @enderror
</div>



<div>
    <label for="service_id">Usluga: </label>
    <select name="service_id">
        <option value="">Odaberi uslugu</option>
        @foreach ($services as $s)
            <option value="{{ $s->id }}"
                {{ old('service_id', $item->service_id ?? '') == $s->id ? 'selected' : '' }}>
                {{ $s->name }}
            </option>
        @endforeach
    </select>
    @error('service_id')
        <span>{{ $message }}</span>
    @enderror
</div>



<div>
    <label for="user_display">Kreirao: </label>
    <input type="hidden" name="user_id" value="{{ old('user_id', $item->user_id ?? Auth::id()) }}">
    <input type="text" id="user_display" value="{{ $item->user->username ?? Auth::user()->username }}" disabled>
    @error('user_id')
        <span>{{ $message }}</span>
    @enderror

</div>



<div>
    <label for="signing_date">Datum kreiranja: </label>
    <input type="date" name="signing_date"
        value="{{ old('signing_date') ?? ($item?->signing_date?->format('Y-m-d') ?? '') }}">
    @error('signing_date')
        <span>{{ $message }}</span>
    @enderror

</div>


<div>
    <label for="note">Napomena: </label>
    <textarea name="note" cols="30" rows="5">{{ old('note', $item->note ?? '') }}</textarea>
    @error('note')
        <span>{{ $message }}</span>
    @enderror
</div>


<div class="checkboxes">
    <label class="checkbox-label" for="is_active">Aktivan: </label>
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" id="is_active" name="is_active" value="1"
        {{ isset($item) && $item->pdf_link ? '' : 'disabled' }}
        {{ old('is_active', $item->is_active ?? false) ? 'checked' : '' }}>
    @error('is_active')
        <span>{{ $message }}</span>
    @enderror
</div>


<div class="checkboxes">
    <label class="checkbox-label" for="is_visible_to_all">Vidljivo svima: </label>
    <input type="hidden" name="is_visible_to_all" value="0">
    <input type="checkbox" id="is_visible_to_all" name="is_visible_to_all" value="1"
        {{ old('is_visible_to_all', $item->is_visible_to_all ?? false) ? 'checked' : '' }}>
    @error('is_visible_to_all')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <button type="submit">{{ isset($item) ? 'Ažuriraj ugovor' : 'Kreiraj ugovor' }}</button>
</div>
