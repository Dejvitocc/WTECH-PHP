<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="with-background">

    <div class="container custom-body-bg">
        <!--Hlavné menu-->
        <header class="container  mt-3 d-flex justify-content-center">
            <div class="row align-items-center w-100">
                <div class="col-lg-2 col-md-2 d-flex justify-content-center">
                    <a href="{{url('/')}}">
                        <img src="{{asset('images/Logo_obchodu.png')}}" alt="Logo stránky" class="logo img-fluid rounded-circle" style="max-height: 100px;">
                    </a>
                </div>
                <div class="col-lg-9 col-md-9 d-flex justify-content-center">
                    <form method="GET" action="{{route('search')}}" class="d-flex w-100 justify-content-center" role="search">
                        <input type="search" name="search" class="form-control form-control-sm text-center me-2" placeholder="Zadajte názov produktu..." aria-label="Vyhľadávanie" value="{{request('search')}}">
                        <button class="btn btn-dark btn-sm me-3" type="submit" id="searchButton">Hľadať</button>
                    </form>
                </div>

            </div>
        </header>

        <main>
            <!--Nadpis-->
            <section class="container mt-4 border-nadpisu w-50">
                <div class="row text-center">
                    <div class="col-12">
                        <h3>
                            Košík
                        </h3>
                    </div>
                </div>
            </section>

            <!-- Vybrané itemy v košíku s popisom a počtom kusov -->
            <section class="container mt-5">
                @if ($cartItems->isEmpty())
                    <p class="text-center">Váš košík je prázdny.</p>
                @else
                    @foreach ($cartItems as $item)
                        <article class="row w-100 d-flex justify-content-center align-items-center border-itemy-kosik mb-3">
                            <!-- Obrázok produktu -->
                            <div class="col-md-3 col-4 me-2">
                                <a href="{{ route('detail_produktu', $item->product->id) }}" >
                                <img src="{{ asset($item->product->images->first()->route ?? 'images/placeholder.jpg') }}" 
                                    alt="{{ $item->product->name ?? 'Produkt' }}" 
                                    class="img-fluid rounded mb-2 img-shopping-cart">
                                </a>
                            </div>

                            <!-- Množstvo -->
                            <div class="col-md-2 col-4 d-flex justify-content-center align-items-center">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PUT')

                                    <!--<button type="button" class="btn btn-sm  me-1" onclick="updateQuantity(this, -1)">−</button>-->

                                    <input type="number" 
                                        name="quantity" 
                                        value="{{ $item->quantity }}" 
                                        min="1" 
                                        class="form-control me-2 text-center" 
                                        style="width: 70%;"
                                        onchange="this.form.submit()">

                                    <!--<button type="button" class="btn btn-sm me-1" onclick="updateQuantity(this, 1)">+</button> -->
                                </form>
                            </div>



                            <!-- Popis (názov produktu, farba, veľkosť) -->
                            <div class="col-md-4 col-8">
                                <h6 class="mb-1">{{ $item->product->name ?? 'Produkt' }}</h6>
                                @if ($item->color || $item->size)
                                    <span class="text-muted small mb-1">
                                        @if($item->color) Farba: {{ $item->color }} @endif
                                        @if($item->size) | Veľkosť: {{ $item->size }} @endif
                                    </span>
                                @endif
                                <p class="mb-0 text-primary fw-bold">{{ number_format($item->product->price, 2) }} €</p>
                            </div>

                            <!-- Tlačidlo na odstránenie -->
                            <div class="col-1 d-flex justify-content-center align-items-center">
                                <a href="{{ route('cart.remove', $item->id) }}" class="btn" title="Odstrániť">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                @endif
            </section>

            <!--Buttony na presmerovanie-->
            <section class="container mt-5 w-100 ">
                <div class="row w-100">
                    <div class="col-4 d-flex justify-content-center">
                        <a href="{{url('/')}}">
                            <button type="button" class="btn btn-dark ">
                                <i class="fas fa-arrow-left">← Pokračovať v nákupe</i>
                            </button>
                        </a>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 d-flex justify-content-center">
                        <a href="{{url('/vytvorenie_objednavky')}}">
                            <button class="btn btn-dark">
                                <i class="fas fa-arrow-left">Pokračovať v objednávke →</i>
                            </button>
                        </a>
                    </div>
                </div>
            </section>
        </main>
        <!--Podpora,obchodné podmienky a iné informácie ohľadom nakupovania-->
        <footer class="container d-flex mt-5 custom-border">
            <div class="row w-100 text-center">
                    <section class=" col-12  col-md-3 col-sm-6 mt-2">
                        <h4>Zákaznícka podpora</h4>
                        <ul  class="no-bullets">
                            <li>Telefónne číslo</li>
                            <li>Pracovné podmienky</li>
                            <li>Email</li>
                        </ul>
                    </section>
                    <section class=" col-12  col-md-3 col-sm-6 mt-2">
                        <h4>Obchodné podmienky</h4>
                        <ul  class="no-bullets">
                            <li>Všeobecné obchodné podmienky</li>
                            <li>Ochrana osobných údajov</li>
                            <li>Cookies</li>
                        </ul>
                    </section>
                    <section class="col-12  col-md-3 col-sm-6 mt-2">
                        <h4>Ako nakupovať</h4>
                        <ul  class="no-bullets">
                            <li>Spôsob platby</li>
                            <li>Spôsob dopravy</li>
                            <li>Výmena a vrátenie</li>
                        </ul>
                    </section>
                    <section class="col-12 col-md-3 col-sm-6 mt-2">
                        <h4>Služby</h4>
                        <ul  class="no-bullets">
                            <li>Darčeková karta</li>
                            <li>Zákaznícka karta</li>
                            <li>Servis</li>
                        </ul>
                    </section>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/kosik.js" defer></script>
</body>
</html>