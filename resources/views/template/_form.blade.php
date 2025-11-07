@csrf

@if (isset($item))
    @method('PUT')
@endif

<div>
    <label for="name">Naziv: </label>
    <input type="text" name="name" value="{{ old('name') ?? ($item->name ?? '') }}" autocomplete="off">
    @error('name')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <button type="submit">{{ isset($item) ? 'Ažuriraj predložak' : 'Kreiraj predložak' }}</button>
</div>
