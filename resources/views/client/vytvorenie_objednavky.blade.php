<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vytvorenie objednávky</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="with-background">
<div class="container custom-body-bg">
    <header class="container">
        <!-- Hlavné menu -->
        <div class="container mt-3 d-flex justify-content-center">
            <div class="row align-items-center w-100">
                <div class="col-lg-2 col-md-2 d-flex justify-content-center">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/Logo_obchodu.png') }}" alt="Logo stránky" class="logo img-fluid rounded-circle" style="max-height: 100px;">
                    </a>
                </div>
                <div class="col-lg-8 col-md-7 d-flex justify-content-center">
                    <form method="GET" action="{{ route('search') }}" class="d-flex w-100 justify-content-center" role="search">
                        <input type="search" name="search" class="form-control form-control-sm text-center me-2" placeholder="Zadajte názov produktu..." aria-label="Vyhľadávanie" value="{{ request('search') }}">
                        <button class="btn btn-dark btn-sm me-3" type="submit" id="searchButton">Hľadať</button>
                    </form>
                </div>
                <div class="col-lg-2 col-md-3 d-flex justify-content-center">
                    @if (Auth::check())
                        <!-- Dropdown pre prihláseného používateľa -->
                        <div class="dropdown">
                            <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 160px">
                                {{ Auth::user()->name }} {{ Auth::user()->surname }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ url('/cart') }}">Košík</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Odhlásiť sa</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- Tlačidlá pre neprihláseného používateľa -->
                        <a href="{{ url('/prihlasenie') }}"><button class="btn btn-dark btn-sm me-1">Prihlásenie</button></a>
                        <a href="{{ url('/cart') }}"><button class="btn btn-dark btn-sm">Košík</button></a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Nadpis -->
        <section class="container mt-4 border-nadpisu w-50">
            <div class="row text-center">
                <div class="col-12">
                    <h3>
                        Fakturačné údaje - Doprava - Platba
                    </h3>
                </div>
            </div>
        </section>

        <!-- Vypĺňanie údajov -->
        <section class="container mt-5">
            <div class="row">
                <div class="col-12 col-md-6 custom-bg">
                    <!-- Osobné info -->
                    <form class="container">
                        @csrf
                        <div class="row">
                            <div class="col-6 col-md-5">
                                <label for="name" class="form-label">Meno:</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name ?? '' }}" required>
                                @error('name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-6 col-md-5">
                                <label for="surname" class="form-label">Priezvisko:</label>
                                <input type="text" id="surname" name="surname" class="form-control" value="{{ $user->surname ?? '' }}" required>
                                @error('surname')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-7">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" id="email" name="email" class="form-control" value="{{ $user->email ?? '' }}" required>
                                @error('email')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-6 col-md-5">
                                <label for="phone-number" class="form-label">Tel. číslo:</label>
                                <input type="text" id="phone-number" name="phone-number" class="form-control" value="{{ $user->phone_number ?? '' }}" required>
                                @error('phone-number')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="street" class="form-label">Ulica:</label>
                                <input type="text" id="street" name="street" class="form-control" value="{{ $user->street ?? '' }}" required>
                                @error('street')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label for="home-number" class="form-label">Číslo domu:</label>
                                <input type="text" id="home-number" name="home-number" class="form-control" value="{{ $user->home_number ?? '' }}" required>
                                @error('home-number')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-5">
                                <label for="postal" class="form-label">PSČ:</label>
                                <input type="text" id="postal" name="postal" class="form-control" value="{{ $user->postal_code ?? '' }}" required>
                                @error('postal')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <label for="city" class="form-label">Mesto:</label>
                                <input type="text" id="city" name="city" class="form-control" value="{{ $user->city ?? '' }}" required>
                                @error('city')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-5">
                                <label for="country" class="form-label">Krajina:</label>
                                <select id="country" name="country" class="form-control" required>
                                    <option value="" disabled {{ !isset($user->country) ? 'selected' : '' }}>Vyberte krajinu</option>
                                    <option value="SK" {{ isset($user->country) && $user->country == 'SK' ? 'selected' : '' }}>Slovensko</option>
                                    <option value="CZ" {{ isset($user->country) && $user->country == 'CZ' ? 'selected' : '' }}>Česká republika</option>
                                    <option value="AT" {{ isset($user->country) && $user->country == 'AT' ? 'selected' : '' }}>Rakúsko</option>
                                    <option value="DE" {{ isset($user->country) && $user->country == 'DE' ? 'selected' : '' }}>Nemecko</option>
                                    <option value="PL" {{ isset($user->country) && $user->country == 'PL' ? 'selected' : '' }}>Poľsko</option>
                                    <option value="HU" {{ isset($user->country) && $user->country == 'HU' ? 'selected' : '' }}>Maďarsko</option>
                                    <option value="FR" {{ isset($user->country) && $user->country == 'FR' ? 'selected' : '' }}>Francúzsko</option>
                                    <option value="IT" {{ isset($user->country) && $user->country == 'IT' ? 'selected' : '' }}>Taliansko</option>
                                    <option value="ES" {{ isset($user->country) && $user->country == 'ES' ? 'selected' : '' }}>Španielsko</option>
                                    <option value="GB" {{ isset($user->country) && $user->country == 'GB' ? 'selected' : '' }}>Veľká Británia</option>
                                </select>
                                @error('country')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- Dopravné spoločnosti/možnosti -->
                        <div class="dropdown mt-3 w-100">
                            <button class="btn btn-light dropdown-toggle w-100" id="deliveryButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Doručenie
                            </button>
                            <ul class="dropdown-menu w-100 text-center">
                                @foreach ($deliveryOptions as $option)
                                    <li>
                                        <a class="dropdown-item d-flex shipping" href="#" onclick="changeDeliveryButtonText('{{ $option->name }}')">
                                            <img src="{{ asset($option->icon_route) }}" alt="{{ $option->name }}" width="16" height="16" class="me-5">
                                            <span>{{ $option->name }}</span>
                                            <span>{{ number_format($option->price, 2) }}€</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Možnosti platby -->
                        <div class="dropdown mt-2 w-100">
                            <button class="btn btn-light dropdown-toggle w-100" id="paymentButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Spôsob platby
                            </button>
                            <ul class="dropdown-menu w-75 text-center">
                                @foreach ($paymentMethods as $method)
                                    <li>
                                        <a class="dropdown-item d-flex" href="#" onclick="changePaymentButtonText('{{ $method->name }}')">
                                            <img src="{{ asset($method->icon_route) }}" alt="{{ $method->name }}" width="16" height="16" class="me-5">
                                            <span>{{ $method->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </form>

                    <!-- Možnosť uplatnenia kupónu -->
                    <form id="coupon-form">
                        <div class="row mt-3 w-100 mt-2">
                            <div class="col-2 me-3 mt-2">
                                <label for="kupon" class="form-label">Kupón:</label>
                            </div>
                            <div class="col-6">
                                <input type="text" id="kupon" name="kupon" class="form-control" required>
                            </div>
                            <div class="col-3 mb-2">
                                <button type="submit" class="btn btn-success">Použiť</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Zhrnutie objednávky -->
                <section class="col-12 col-md-6 custom-bg">
                    <div id="order-products">
                        @foreach($cartItems as $item)
                            <article class="row w-100 d-flex justify-content-center align-items-center mt-3 mb-3">
                                <!-- Obrázok produktu -->
                                <div class="col-4 d-flex justify-content-center">
                                    <img src="{{ asset($item->product->images->first()->route ?? 'images/placeholder.jpg') }}"
                                         alt="{{ $item->product->name }}"
                                         class="img-fluid"
                                         style="max-height: 70px;">
                                </div>

                                <!-- Množstvo -->
                                <div class="col-4 d-flex justify-content-center align-items-center">
                                    <input type="number"
                                           value="{{ $item->quantity }}"
                                           class="form-control me-2"
                                           style="width: 60%;"
                                           readonly>
                                </div>

                                <!-- Popis produktu -->
                                <div class="col-4 text-center">
                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                    @if($item->color || $item->size)
                                        <small class="text-muted">
                                            @if($item->color) Farba: {{ $item->color }} @endif
                                            @if($item->size) | Veľkosť: {{ $item->size }} @endif
                                        </small>
                                    @endif
                                    <p class="mb-0 text-primary fw-bold">
                                        {{ number_format($item->product->price, 2) }} €
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12 mt-5 season-bg">
                            <label class="form-label">
                                    <span id="cartTotal" data-original-total="{{ $cartItems->sum(function($item) {
                                                return $item->product->price * $item->quantity;
                                            }) }}">
                                        {{ number_format($cartItems->sum(function($item) {
                                            return $item->product->price * $item->quantity;
                                        }), 2) }}
                                    </span> €
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3 text-center">
                            <a href="{{ url('/platobna_brana') }}">
                                <button class="btn btn-success">Objednať s povinnosťou platby</button>
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <!-- Podpora, obchodné podmienky a iné informácie -->
        <footer class="container d-flex mt-5 custom-border">
            <div class="row w-100 text-center">
                <div class="col-12 col-md-3 col-sm-6 mt-2">
                    <h4>Zákaznícka podpora</h4>
                    <ul class="no-bullets">
                        <li>Telefónne číslo</li>
                        <li>Pracovné podmienky</li>
                        <li>Email</li>
                    </ul>
                </div>
                <div class="col-12 col-md-3 col-sm-6 mt-2">
                    <h4>Obchodné podmienky</h4>
                    <ul class="no-bullets">
                        <li>Všeobecné obchodné podmienky</li>
                        <li>Ochrana osobných údajov</li>
                        <li>Cookies</li>
                    </ul>
                </div>
                <div class="col-12 col-md-3 col-sm-6 mt-2">
                    <h4>Ako nakupovať</h4>
                    <ul class="no-bullets">
                        <li>Spôsob platby</li>
                        <li>Spôsob dopravy</li>
                        <li>Výmena a vrátenie</li>
                    </ul>
                </div>
                <div class="col-12 col-md-3 col-sm-6 mt-2">
                    <h4>Služby</h4>
                    <ul class="no-bullets">
                        <li>Darčeková karta</li>
                        <li>Zákaznícka karta</li>
                        <li>Servis</li>
                    </ul>
                </div>
            </div>
        </footer>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('js/vytvorenie_objednavky.js') }}" defer></script>
</body>
</html>

