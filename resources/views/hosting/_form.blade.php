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
    <label for="package_name">Naziv paketa: </label>
    <input type="text" name="package_name" value="{{ old('package_name') ?? ($item?->package_name ?? '') }}">
    @error('package_name')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="package_description">Opis paketa: </label>
    <textarea name="package_description" cols="30" rows="10">
        {{ old('package_description') ?? ($item?->package_description ?? '') }}
    </textarea>
    @error('package_description')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="price">Cijena: </label>
    <input type="text" name="price" value="{{ old('price') ?? ($item?->price ?? '') }}">
    @error('price')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="expiration_date">Datum isteka hostinga: </label>
    <input type="date" name="expiration_date"
        value="{{ old('expiration_date') ?? ($item?->expiration_date?->format('Y-m-d') ?? '') }}">
    @error('expiration_date')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <button type="submit">{{ isset($item) ? 'Ažuriraj hosting' : 'Kreiraj hosting' }}</button>
</div>
