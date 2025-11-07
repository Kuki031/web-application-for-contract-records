@csrf

@if (isset($item))
    @method('PUT')
@endif

<div>
    <label for="price">Cijena: </label>
    <input type="text" name="price" value="{{ old('price') ?? ($item->price ?? '') }}" autocomplete="off">
    @error('price')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="price_words">Cijena (u riječima): </label>
    <textarea cols="50" rows="20" name="price_words">{{ old('price_words') ?? ($item->price_words ?? '') }}</textarea>
    @error('price_words')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="currency">Valuta: </label>
    @if (isset($item))
        <select name="currency">
            <option value="{{ $item->currency }}">{{ $item->currency }}</option>
            @foreach (\App\Enums\Currency::cases() as $currency)
                @if ($currency->value === $item->currency)
                    @continue
                @else
                    <option value="{{ $currency->value }}">
                        {{ $currency }}
                    </option>
                @endif
            @endforeach
        </select>
    @else
        <select name="currency">
            <option value="">Odaberi valutu</option>
            @foreach (\App\Enums\Currency::cases() as $currency)
                <option value="{{ $currency->value }}">
                    {{ $currency }}
                </option>
            @endforeach
        </select>
    @endif
    @error('currency')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <button type="submit">{{ isset($item) ? 'Ažuriraj cijenu' : 'Kreiraj cijenu' }}</button>
</div>
