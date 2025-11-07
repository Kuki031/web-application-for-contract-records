@csrf

@if (isset($item))
    @method('PUT')
@endif

<div>
    <label for="name">Ime: </label>
    <input type="text" name="name" value="{{ old('name') ?? ($item->name ?? '') }}" autocomplete="off">
    @error('name')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="address">Adresa: </label>
    <textarea cols="50" rows="3" name="address">{{ old('address') ?? ($item->address ?? '') }}</textarea>
    @error('address')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="oib">OIB: </label>
    <input type="text" name="oib" value="{{ old('oib') ?? ($item->oib ?? '') }}" autocomplete="off">

    @error('oib')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="representer">Predstavnik: </label>
    <input type="text" name="representer" value="{{ old('representer') ?? ($item->representer ?? '') }}"
        autocomplete="off">

    @error('representer')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="connection_tag">Vezna oznaka: </label>
    <input type="text" name="connection_tag" value="{{ old('connection_tag') ?? ($item->connection_tag ?? '') }}"
        autocomplete="off">
    @error('connection_tag')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="type_of_partner">Vrsta partnera: </label>
    <input type="text" name="type_of_partner" value="{{ old('type_of_partner') ?? ($item->type_of_partner ?? '') }}"
        autocomplete="off">
    @error('type_of_partner')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="phone">Telefon: </label>
    <input type="text" name="phone" value="{{ old('phone') ?? ($item->phone ?? '') }}" autocomplete="off">

    @error('phone')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="email">E-mail adresa: </label>
    <input type="text" name="email" value="{{ old('email') ?? ($item->email ?? '') }}" autocomplete="off">
    @error('email')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="seller">Prodavač: </label>
    <input type="text" name="seller" value="{{ old('seller') ?? ($item->seller ?? '') }}" autocomplete="off">

    @error('seller')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="activities">Aktivnosti: </label>
    <input type="text" name="activities" value="{{ old('activities') ?? ($item->activities ?? '') }}"
        autocomplete="off">
    @error('activities')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="city">Grad: </label>
    <input type="text" name="city" value="{{ old('city') ?? ($item->city ?? '') }}" autocomplete="off">
    @error('city')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="country">Država: </label>
    <input type="text" name="country" value="{{ old('country') ?? ($item->country ?? '') }}" autocomplete="off">

    @error('country')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <button type="submit">{{ isset($item) ? 'Ažuriraj klijenta' : 'Kreiraj klijenta' }}</button>
</div>
