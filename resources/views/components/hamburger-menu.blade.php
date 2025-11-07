<div style="display:none;" class="hamburger-wrap">
    @auth
        <div>
            <div>
                <a class="header-btn" href={{ route('client.index') }}>
                    Klijenti
                </a>
            </div>

            <div>
                <a class="header-btn" href={{ route('contract.index') }}>
                    Ugovori
                </a>
            </div>

            <div>
                <a class="header-btn" href={{ route('payment.index') }}>
                    Plaćanja
                </a>
            </div>

            <div>
                <a class="header-btn" href={{ route('template.index') }}>
                    Predlošci
                </a>
            </div>

            <div>
                <a class="header-btn" href={{ route('service.index') }}>
                    Usluge
                </a>
            </div>

            <div>
                <a class="header-btn" href={{ route('price.index') }}>
                    Cijene
                </a>
            </div>

            @if (Auth::user()->is_admin)
                <div>
                    <a class="header-btn" href={{ route('admin.index') }}>
                        Korisnici
                    </a>
                </div>
                <div>
                    <a class="header-btn" href={{ route('log.index') }}>
                        Zapisi
                    </a>
                </div>
                <div>
                    <a class="header-btn" href={{ route('domain.index') }}>
                        Domene
                    </a>
                </div>
                <div>
                    <a class="header-btn" href={{ route('hosting.index') }}>
                        Hostings
                    </a>
                </div>
            @endif
        </div>

        <div>
            <a class="header-btn" href={{ route('dashboard') }}>
                Upravljačka ploča
            </a>
        </div>
        <div>
            <a class="header-btn" href={{ route('user.edit', ['user' => Auth::user()]) }}>
                Moj profil
            </a>
        </div>

        <div>
            <form action={{ route('auth.logout') }} method="post">
                @csrf
                <input class="header-btn log-out" type="submit" value="Odjavi se">
            </form>
        </div>
    @endauth
</div>
