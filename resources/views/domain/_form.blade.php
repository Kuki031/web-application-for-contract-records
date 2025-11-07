@csrf

@if (isset($item))
    @method('PUT')
@endif


<div>
    <label for="name">Ime domene: </label>
    <input type="text" name="name" value="{{ old('name') ?? ($item?->name ?? '') }}">
    @error('name')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="type">Vrsta domene: </label>
    <select name="type">
        <option value="">Odaberite vrstu domene</option>
        <option value="free" {{ old('type', $item?->type) == 'free' ? 'selected' : '' }}>Besplatna</option>
        <option value="paid" {{ old('type', $item?->type) == 'paid' ? 'selected' : '' }}>Plaćena</option>
    </select>
    @error('type')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="registrar">Registrar: </label>
    <input type="text" name="registrar" value="{{ old('registrar') ?? ($item?->registrar ?? '') }}">
    @error('registrar')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="user">Korisnik: </label>
    <input type="text" name="user" value="{{ old('user') ?? ($item?->user ?? '') }}">
    @error('user')
        <span>{{ $message }}</span>
    @enderror
</div>

<div class="radio-input">
    <label for="has_access">Pravo pristupa?: </label>
    <div class="radio-input-wrap">
        <label class="radio-option">
            <input type="radio" name="has_access" value="1"
                {{ old('has_access', $item?->has_access) == 1 ? 'checked' : '' }}>
            <span class="radio-span">Da</span>
        </label>
        <label class="radio-option">
            <input type="radio" name="has_access" value="0"
                {{ old('has_access', $item?->has_access) == 0 ? 'checked' : '' }}>
            <span class="radio-span">Ne</span>
        </label>
    </div>
    @error('has_access')
        <span>{{ $message }}</span>
    @enderror
</div>


<div class="radio-input">
    <label for="is_redirected">Domena preusmjerena?: </label>
    <div class="radio-input-wrap">
        <label class="radio-option">
            <input class="input-r" type="radio" name="is_redirected" value="1"
                {{ old('is_redirected', $item?->is_redirected) == 1 ? 'checked' : '' }}>
            <span class="radio-span">Da</span>
        </label>
        <label class="radio-option">
            <input class="input-r" type="radio" name="is_redirected" value="0"
                {{ old('is_redirected', $item?->is_redirected) == 0 ? 'checked' : '' }}>
            <span class="radio-span">Ne</span>
        </label>
    </div>
    @error('is_redirected')
        <span>{{ $message }}</span>
    @enderror
</div>



<div>
    <label class="hidden" for="is_redirected_where">Domena preusmjerena gdje?: </label>
    <input class="hidden" type="text" name="is_redirected_where"
        value="{{ old('is_redirected_where') ?? ($item?->is_redirected_where ?? '') }}">
    @error('is_redirected_where')
        <span>{{ $message }}</span>
    @enderror
</div>

<div>
    <label for="expires_at">Datum isteka domene: </label>
    <input type="date" name="expires_at"
        value="{{ old('expires_at') ?? ($item?->expires_at?->format('Y-m-d') ?? '') }}">
    @error('expires_at')
        <span>{{ $message }}</span>
    @enderror
</div>


<div class="client-input">
    <label for="client_id">Klijent: </label>
    <select name="client_id" id="client">
        <option value="">Odaberi klijenta</option>
        @foreach ($clients as $c)
            <option value="{{ $c->id }}"
                {{ old('client_id', $item?->client_id ?? '') == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select>
    @error('client_id')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <button type="submit">{{ isset($item) ? 'Ažuriraj domenu' : 'Kreiraj domenu' }}</button>
</div>
