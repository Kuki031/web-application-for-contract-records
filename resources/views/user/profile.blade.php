<x-header />
<x-flash />

<div class="profile-wrap">
    <div class="profile-main">
        <form class="form" action={{ route('user.update', ['user' => Auth::user()]) }} method="post">
            @csrf
            @method('PUT')

            <div class="profile-field">
                <label for="username">Korisničko ime: </label>
                <input type="text" name="username" value="{{ Auth::user()->username }}" readonly disabled>
            </div>


            <div class="profile-field">
                <label for="password">Trenutna lozinka: </label>
                <input type="password" name="password">
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>


            <div class="profile-field">
                <label for="password_new">Nova lozinka: </label>
                <input type="password" name="password_new">
                @error('password_new')
                    <span>{{ $message }}</span>
                @enderror
            </div>


            <div class="profile-field">
                <label for="password_confirm">Ponovi novu lozinku: </label>
                <input type="password" name="password_confirm">
                @error('password_confirm')
                    <span>{{ $message }}</span>
                @enderror
            </div>


            <div class="profile-field">
                <button type="submit">Spremi promjene</button>
            </div>

        </form>
    </div>
</div>
