<x-header />
<x-flash />


<div class="auth-wrap">
    <div class="auth-main">
        <form class="form" action={{ route('auth.authenticate') }} method="post">
            @csrf
            <div class="auth-field">
                <label for="username">Korisničko ime: </label>
                <input type="text" name="username">
                    @error('username')
                    <span>{{ $message }}</span>
                    @enderror
            </div>

            <div class="auth-field">
                <label for="password">Lozinka: </label>
                <input type="password" name="password">

                @error('password')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-field">
                <button type="submit">Prijavi se</button>
            </div>
        </form>
    </div>
</div>
