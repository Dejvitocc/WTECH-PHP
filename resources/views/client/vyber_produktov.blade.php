<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výber produktov</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="with-background">
<div class="container custom-body-bg">
    <!--Hlavné menu-->
    <header class="container mt-3 d-flex justify-content-center">
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
                        <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 160px">
                            {{ Auth::user()->name }} {{ Auth::user()->surname }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ url('/cart') }}">Košík</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pouzivatelske_udaje') }}">Údaje</a></li>
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

    <!--Kategórie výberu-->
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
                <select class="form-select form-select-lg" onchange="openCategory(this.value)">
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

    <!--Zobrazenie v akej kategórii sa aktuálne nachádzame-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb custom-breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}" class="custom-link">Domov</a></li>
            <li class="breadcrumb-item active" id="current-category" aria-current="page"></li>
        </ol>
    </nav>

    <main>
        <section class="container mt-5">
            <div class="row text-center d-flex justify-content-center" id="subcategory-container">
                <!-- Podkategórie sa sem vložia dynamicky -->
            </div>
        </section>
        <div class="custom-border mt-3"></div>

        <section class="container mt-3">
            <div class="row">
                <!-- Veľkosť Filter -->
                <div class="col">
                    <div class="dropdown">
                        @php
                            $sizesQuery = request()->query('size');
                            $sizeDisplay = null;
                            if ($sizesQuery) {
                                $sizeDisplay = is_array($sizesQuery) ? implode(', ', $sizesQuery) : $sizesQuery;
                            }
                        @endphp
                        <button class="filter-button dropdown-toggle" type="button" id="sizeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if($sizeDisplay)
                                Veľkosť: {{ $sizeDisplay }}
                            @else
                                Veľkosť
                            @endif
                        </button>
                        <div class="dropdown-menu p-3" aria-labelledby="sizeDropdown" style="min-width: 200px;" data-bs-auto-close="outside">
                            <div style="max-height: 200px; overflow-y: auto;">
                                <ul class="list-unstyled m-0">
                                    @foreach($sizes as $size)
                                        <li>
                                            <a class="dropdown-item {{ ($sizesQuery && (is_array($sizesQuery) ? in_array($size, $sizesQuery) : $sizesQuery == $size)) ? 'active' : '' }}"
                                               href="{{ route('kategorie', array_merge(request()->query(), ['size' => $size])) }}">
                                                {{ $size }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <a href="{{ route('kategorie', array_merge(request()->query(), ['size' => null])) }}" class="btn btn-secondary btn-sm w-100 mt-2">Zrušiť filter</a>
                        </div>
                    </div>
                </div>

                <!-- Farba Filter -->
                <div class="col">
                    <div class="dropdown">
                        @php
                            $colorsQuery = request()->query('color');
                            $colorDisplay = null;
                            if ($colorsQuery) {
                                $colorDisplay = is_array($colorsQuery) ? implode(', ', $colorsQuery) : $colorsQuery;
                            }
                        @endphp
                        <button class="filter-button dropdown-toggle" type="button" id="colorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if($colorDisplay)
                                Farba: {{ $colorDisplay }}
                            @else
                                Farba
                            @endif
                        </button>
                        <div class="dropdown-menu p-3" aria-labelledby="colorDropdown" style="min-width: 200px;" data-bs-auto-close="outside">
                            <div style="max-height: 200px; overflow-y: auto;">
                                <ul class="list-unstyled m-0">
                                    @foreach($colors as $color)
                                        <li>
                                            <a class="dropdown-item {{ ($colorsQuery && (is_array($colorsQuery) ? in_array($color, $colorsQuery) : $colorsQuery == $color)) ? 'active' : '' }}"
                                               href="{{ route('kategorie', array_merge(request()->query(), ['color' => $color])) }}">
                                                {{ $color }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <a href="{{ route('kategorie', array_merge(request()->query(), ['color' => null])) }}" class="btn btn-secondary btn-sm w-100 mt-2">Zrušiť filter</a>
                        </div>
                    </div>
                </div>

                <!-- Cena Filter -->
                <div class="col">
                    <div class="dropdown">
                        <button class="filter-button dropdown-toggle" type="button" id="priceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(request()->query('priceFrom') || request()->query('priceTo'))
                                Cena: {{ request()->query('priceFrom', '0') }}€ - {{ request()->query('priceTo', '∞') }}€
                            @else
                                Cena
                            @endif
                        </button>
                        <div class="dropdown-menu p-3" aria-labelledby="priceDropdown" style="min-width: 200px;" data-bs-auto-close="outside">
                            <form method="GET" action="{{ route('kategorie') }}" id="priceFilterForm" novalidate>
                                @foreach (request()->query() as $key => $value)
                                    @if ($key !== 'priceFrom' && $key !== 'priceTo')
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                                <div class="mb-2">
                                    <label for="priceFrom" class="form-label">Od:</label>
                                    <input type="text" class="form-control form-control-sm" id="priceFrom" name="priceFrom" placeholder="0€" value="{{ request()->query('priceFrom') }}">
                                </div>
                                <div class="mb-2">
                                    <label for="priceTo" class="form-label">Do:</label>
                                    <input type="text" class="form-control form-control-sm" id="priceTo" name="priceTo" placeholder="100€" value="{{ request()->query('priceTo') }}">
                                </div>
                                <button type="submit" class="btn btn-dark btn-sm w-100 mb-1">Aplikovať</button>
                                <a href="{{ route('kategorie', array_merge(request()->query(), ['priceFrom' => null, 'priceTo' => null])) }}" class="btn btn-secondary btn-sm w-100">Zrušiť filter</a>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Značka Filter -->
                <div class="col">
                    <div class="dropdown">
                        @php
                            $brandsQuery = request()->query('brand');
                            $brandDisplay = null;
                            if ($brandsQuery) {
                                $brandDisplay = is_array($brandsQuery) ? implode(', ', $brandsQuery) : $brandsQuery;
                            }
                        @endphp
                        <button class="filter-button dropdown-toggle" type="button" id="brandDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if($brandDisplay)
                                Značka: {{ $brandDisplay }}
                            @else
                                Značka
                            @endif
                        </button>
                        <div class="dropdown-menu p-3" aria-labelledby="brandDropdown" style="min-width: 200px;" data-bs-auto-close="outside">
                            <div style="max-height: 200px; overflow-y: auto;">
                                <ul class="list-unstyled m-0">
                                    @foreach($brands as $brand)
                                        <li>
                                            <a class="dropdown-item {{ ($brandsQuery && (is_array($brandsQuery) ? in_array($brand, $brandsQuery) : $brandsQuery == $brand)) ? 'active' : '' }}"
                                               href="{{ route('kategorie', array_merge(request()->query(), ['brand' => $brand])) }}">
                                                {{ $brand }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <a href="{{ route('kategorie', array_merge(request()->query(), ['brand' => null])) }}" class="btn btn-secondary btn-sm w-100 mt-2">Zrušiť filter</a>
                        </div>
                    </div>
                </div>

                <!-- Resetovať filtre -->
                <div class="col d-flex align-items-center">
                    <a href="{{ route('kategorie', ['kategoria' => $kategoria, 'podkategoria' => $podkategoria]) }}"
                       class="order-by-button btn  btn-sm" style="border-color: black; width: 150px">
                        Resetovať filtre
                    </a>
                </div>

                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>

                <!-- Zoradenie -->
                <div class="col">
                    <div class="dropdown">
                        <button class="order-by-button dropdown-toggle" type="button" id="orderBy" data-bs-toggle="dropdown" aria-expanded="false">
                            Zoradiť podľa
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="orderBy">
                            <li>
                                <a class="dropdown-item {{ $sort == 'newest' ? 'active' : '' }}"
                                   href="{{ route('kategorie', array_merge(request()->query(), ['sort' => 'newest'])) }}">
                                    Najnovšie
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ $sort == 'lowest-price' ? 'active' : '' }}"
                                   href="{{ route('kategorie', array_merge(request()->query(), ['sort' => 'lowest-price'])) }}">
                                    Najnižšia cena
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ $sort == 'highest-price' ? 'active' : '' }}"
                                   href="{{ route('kategorie', array_merge(request()->query(), ['sort' => 'highest-price'])) }}">
                                    Najvyššia cena
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Jednotlivé karty pre produkty v danej kategórii -->
        <section class="container mt-5">
            <div class="row">
                @forelse($products as $product)
                    <article class="col-md-3">
                        <a href="{{ route('detail_produktu', $product->id) }}" class="text-decoration-none card-link">
                            <div class="card">
                                @if($product->images->isNotEmpty())
                                    <img src="{{ asset($product->images->first()->route) }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="Žiadny obrázok">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">
                                    <p>{{ number_format($product->price, 2) }}€</p>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    <div class="col-12 text-center">
                        @if($search)
                            <p>Žiadne produkty s daným názvom.</p>
                        @else
                            <p>Žiadne produkty v tejto kategórii.</p>
                        @endif
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Prepínanie medzi viacerými stránkami produktov -->
        <nav aria-label="Page navigation" class="mt-2">
            <ul class="pagination justify-content-center">
                {{ $products->links('bootstrap-5') }}
            </ul>
        </nav>
    </main>

    <!--Podpora,obchodné podmienky a iné informácie ohľadom nakupovania-->
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!--Pomoc z tutoriálu https://www.youtube.com/watch?v=3AWNCldVaH0-->
<script src="{{asset('js/vyber_produktov.js')}}" defer></script>
</body>
</html>
