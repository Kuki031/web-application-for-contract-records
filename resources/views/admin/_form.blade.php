@csrf

@if (isset($item))
    @method('PUT')
@endif

<div>
    <label for="username">Korisničko ime: </label>
    <input type="text" name="username" value="{{ old('username') ?? ($item->username ?? '') }}" autocomplete="off">
    @error('username')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="password">Lozinka: </label>
    <input type="password" name="password">
    @error('password')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <label for="password_same">Ponovi lozinku: </label>
    <input type="password" name="password_same">
    @error('password_same')
        <span>{{ $message }}</span>
    @enderror
</div>


<div>
    <button type="submit">{{ isset($item) ? 'Ažuriraj korisnika' : 'Kreiraj korisnika' }}</button>
</div>
