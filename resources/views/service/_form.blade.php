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
    <label for="description">Opis: </label>
    <textarea cols="50" rows="20" name="description">{{ old('description') ?? ($item->description ?? '') }}</textarea>
    @error('description')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <button type="submit">{{ isset($item) ? 'Ažuriraj uslugu' : 'Kreiraj uslugu' }}</button>
</div>
