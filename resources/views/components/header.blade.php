<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ugovori - Ofir</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <div class="header-wrap">
            <div class="header-wrap__logo">

            </div>

            @auth
                <div class="header-wrap__container">
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

                <div class="header-wrap__container">
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
                </div>
            @endauth
            <div class="hamburger hidden"></div>
        </div>
    </header>
    <x-hamburger-menu />
</body>

</html>
