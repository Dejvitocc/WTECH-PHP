<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hlavná stránka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="with-background">
<div class="container custom-body-bg">
    <!-- Hlavné menu, ktoré obsahuje logo obchodu, vyhľadávací bar a používateľské menu -->
    <header class="container  mt-3 d-flex justify-content-center">
        <div class="row align-items-center w-100">
            <div class="col-lg-2 col-md-2 d-flex justify-content-center">
                <a href="{{url('/')}}">
                    <img src="{{asset('images/Logo_obchodu.png')}}" alt="Logo stránky" class="logo img-fluid rounded-circle" style="max-height: 100px;">
                </a>
            </div>
            <div class="col-lg-8 col-md-8 d-flex justify-content-center">
                <form method="GET" action="{{route('search')}}" class="d-flex w-100 justify-content-center" role="search">
                    <input type="search" name="search" class="form-control form-control-sm text-center me-2" placeholder="Zadajte názov produktu..." aria-label="Vyhľadávanie" value="{{request('search')}}">
                    <button class="btn btn-dark btn-sm me-3" type="submit" id="searchButton">Hľadať</button>
                </form>
            </div>
            <div class="col-lg-2 col-md-2 d-flex justify-content-center">
                @if (Auth::check())
                    <!-- Dropdown pre prihláseného používateľa -->
                    <div class="dropdown">
                        <button class="btn btn-dark btn-sm dropdown-toggle " type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 160px">
                            {{ Auth::user()->name }} <!--{{ Auth::user()->surname }}-->
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown" >
                            <li><a class="dropdown-item" href="{{ url('/cart') }}">Košík</a></li>
                            <li><a class="dropdown-item" href="{{ url('/user_data') }}">Údaje</a></li>
                            @if (Auth::user()->email === 'admin@admin.sk') 
                                <li><a class="dropdown-item" href="{{ url('/admin') }}">Admin Panel</a></li>
                            @endif
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
                    <a href="{{ url('/prihlasenie') }}"><button class="btn btn-dark btn-sm me-2">Prihlásenie</button></a>
                    <a href="{{ url('/cart') }}"><button class="btn btn-dark btn-sm me-1">Košík</button></a>
                @endif
            </div>
        </div>
    </header>

    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Kategórie výberu -->
    <nav class="container custom-bg mb-5">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 d-none d-md-flex justify-content-center">
                <button class="btn v_btn btn-dark btn-lg me-4 w-75" onclick="openCategory('muzi')">Muži</button>
                <button class="btn v_btn btn-dark btn-lg me-4 w-75" onclick="openCategory('zeny')">Ženy</button>
                <button class="btn v_btn btn-dark btn-lg me-4 w-75" onclick="openCategory('deti')">Deti</button>
                <button class="btn v_btn btn-dark btn-lg me-4 w-75" onclick="openCategory('sporty')">Športy</button>
            </div>
            <!-- Dropdown pre menšie obrazovky -->
            <div class="col-8 d-md-none w-100">
                <select class="form-select form-select-lg" onchange="openCategory(this.value)" aria-label="Vyberte kategóriu">
                    <option value="" selected disabled>Vyberte kategóriu</option>
                    <option value="muzi">Muži</option>
                    <option value="zeny">Ženy</option>
                    <option value="deti">Deti</option>
                    <option value="sporty">Športy</option>
                </select>
            </div>
            <div class="col-2"></div>
        </div>
    </nav>
    <main>
        <!-- Sezónna ponuka -->
        <section class="container mt-2">
            <div class="row w-100 g-4">
                <div class="col-12 col-md-4 season-bg d-flex flex-column justify-content-center">
                    <h2 style="font-size: 24px;">Jar je už za dverami!</h2>
                    <p>
                        Jar je ideálnym časom na zmenu, a čo lepšie ako začať
                        s novým športovým vybavením? Ponúkame široký výber kvalitného športového vybavenia,
                        ktoré vám pomôže dosiahnuť vaše fitness ciele a vychutnať si každú aktivitu vonku.
                    </p>
                </div>
                <div class="col-12 col-md-8 d-flex justify-content-center">
                    <img src="{{ asset('images/jar_ponuka.jpg') }}" alt="Jar" class="img-fluid rounded" style="object-fit: cover;">
                </div>
            </div>
        </section>

        <!-- Novinky -->
        <section class="container custom-bg mt-5 d-flex justify-content-center">
            <div class="row w-100">
                <div class="col-12 w-100">
                    <h2>Novinky</h2>
                </div>
                <div class="col-12 w-100">
                    <div class="carousel slide" data-bs-ride="carousel" id="carouselExample">
                        <div class="carousel-inner d-flex justify-content-start">
                            @foreach($newProducts as $index => $product)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="col-12 col-md-3">
                                        <a href="{{ route('detail_produktu', $product->id) }}" class="text-decoration-none card-link">
                                            <div class="card">
                                                @if($product->images->isNotEmpty())
                                                    <img src="{{ asset($product->images->first()->route) }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top img-fluid" alt="No image">
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $product->name }}</h5>
                                                    <p class="card-text">
                                                    <p>{{ number_format($product->price, 2) }}€</p>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev bg-dark" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next bg-dark" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Populárne -->
        <section class="container custom-bg mt-5 d-flex justify-content-center">
            <div class="row w-100">
                <div class="col-12 w-100">
                    <h2>Populárne</h2>
                </div>
                <div class="col w-100">
                    <div class="carousel slide" data-bs-ride="carousel" id="carouselExample2">
                        <div class="carousel-inner">
                            @foreach($popularProducts as $index => $product)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="col-12 col-md-3">
                                        <a href="{{ route('detail_produktu', $product->id) }}" class="text-decoration-none card-link">
                                            <div class="card">
                                                @if($product->images->isNotEmpty())
                                                    <img src="{{ asset($product->images->first()->route) }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top img-fluid" alt="No image">
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $product->name }}</h5>
                                                    <p class="card-text">
                                                    <p>{{ number_format($product->price, 2) }}€</p>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev bg-dark" type="button" data-bs-target="#carouselExample2" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next bg-dark" type="button" data-bs-target="#carouselExample2" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kto sme -->
        <section class="container mt-5 d-flex justify-content-center">
            <div class="row w-100 text-center">
                <div class="col-12">
                    <h2>Kto sme?</h2>
                </div>
                <article class="col-12 season-bg">
                    <p>
                        Vitajte na MD – vašom spoľahlivom partnerovi pre všetky športové potreby!
                        Sme e-shop, ktorý sa špecializuje na predaj kvalitného športového vybavenia
                        pre širokú verejnosť. Naša ponuka zahŕňa produkty pre rôzne športy, od behu,
                        cyklistiky, fitness až po tímové športy, outdoorové aktivity a mnoho ďalších.
                    </p>
                    <p>
                        Naším cieľom je poskytovať našim zákazníkom produkty najvyššej kvality za výhodné
                        ceny, ktoré im pomôžu dosiahnuť svoje športové ciele a zlepšiť ich výkon. Nezáleží na
                        tom, či ste profesionál, alebo začiatočník – v našom e-shope nájdete všetko, čo potrebujete
                        na tréning, súťaže a rekreačné aktivity.
                    </p>
                    <p>
                        V MD sa zameriavame na kvalitu, rýchlosť a skvelý zákaznícky servis. Naša široká ponuka
                        produktov je neustále aktualizovaná, aby sme vám priniesli najnovšie trendy a technologické
                        novinky vo svete športu.
                    </p>
                    <p>
                        Sme tu, aby sme vám pomohli byť najlepšou verziou seba – či už v telocvični, na trati, alebo
                        v prírode. Ďakujeme, že ste sa rozhodli nakupovať práve u nás!
                    </p>
                </article>
            </div>
        </section>
    </main>
    <footer>
        <!-- Podpora a obchodné podmienky -->
        <div class="container d-flex mt-5 custom-border">
            <div class="row w-100 text-center">
                <section class="col-12 col-md-3 col-sm-6 mt-2">
                    <h4>Zákaznícka podpora</h4>
                    <ul class="no-bullets">
                        <li>Telefónne číslo</li>
                        <li>Pracovné podmienky</li>
                        <li>Email</li>
                    </ul>
                </section>
                <section class="col-12 col-md-3 col-sm-6 mt-2">
                    <h4>Obchodné podmienky</h4>
                    <ul class="no-bullets">
                        <li>Všeobecné obchodné podmienky</li>
                        <li>Ochrana osobných údajov</li>
                        <li>Cookies</li>
                    </ul>
                </section>
                <section class="col-12 col-md-3 col-sm-6 mt-2">
                    <h4>Ako nakupovať</h4>
                    <ul class="no-bullets">
                        <li>Spôsob platby</li>
                        <li>Spôsob dopravy</li>
                        <li>Výmena a vrátenie</li>
                    </ul>
                </section>
                <section class="col-12 col-md-3 col-sm-6 mt-2">
                    <h4>Služby</h4>
                    <ul class="no-bullets">
                        <li>Darčeková karta</li>
                        <li>Zákaznícka karta</li>
                        <li>Servis</li>
                    </ul>
                </section>
            </div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('js/index.js') }}" defer></script>
</body>
</html>
