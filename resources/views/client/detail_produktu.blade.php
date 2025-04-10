@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail produktu - Športový e-shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="with-background">
<div class="container custom-body-bg">
  <header class="mt-3">
    <div class="row align-items-center">
      <div class="col-lg-2 col-md-2 d-flex justify-content-center">
        <a href="{{url('/')}}" aria-label="Domov">
          <img src="{{asset('images/Logo_obchodu.png')}}" alt="Logo športového e-shopu" class="logo img-fluid rounded-circle" style="max-height: 100px;">
        </a>
      </div>
      <div class="col-lg-8 col-md-7 d-flex justify-content-center">
        <form method="GET" action="{{route('search')}}" class="d-flex w-100 justify-content-center" role="search">
          <input type="search" name="search" class="form-control form-control-sm text-center me-2" placeholder="Zadajte názov produktu..." aria-label="Vyhľadávanie" value="{{request('search')}}">
          <button class="btn btn-dark btn-sm me-3" type="submit" id="searchButton">Hľadať</button>
        </form>
      </div>
      <div class="col-lg-2 col-md-3 d-flex justify-content-center">
        <a href="{{url('/prihlasenie')}}"><button class="btn btn-dark btn-sm me-1">Prihlásenie</button></a>
        <a href="{{url('/cart')}}"><button class="btn btn-dark btn-sm">Košík</button></a>
      </div>
    </div>
  </header>

  <nav class="container custom-bg mb-5">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8 d-none d-md-flex justify-content-center">
        <button class="btn v_btn btn-dark btn-lg me-4 w-75" onclick="openCategory('muzi')">Muži</button>
        <button class="btn v_btn btn-dark btn-lg me-4 w-75" onclick="openCategory('zeny')">Ženy</button>
        <button class="btn v_btn btn-dark btn-lg me-4 w-75" onclick="openCategory('deti')">Deti</button>
        <button class="btn v_btn btn-dark btn-lg me-4 w-75" onclick="openCategory('sporty')">Športy</button>
      </div>
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

  <div class="custom-border mt-3 mb-3"></div>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb custom-breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}" >Domov</a></li>
      <li class="breadcrumb-item active" id="current-category" aria-current="page"></li>
    </ol>
  </nav>

  <main class="container mt-5">
    <article class="row">

        <!-- Hlavný obrázok -->
        <div class="col-md-6 main-image-container">
            @if($product->images->isNotEmpty())
                <img src="{{ asset($product->images->first()->route) }}" alt="{{ $product->name }}" class="main-image img-fluid" id="mainImage">
            @else
                <img src="{{ asset('images/placeholder.jpg') }}" alt="Žiadny obrázok" class="main-image img-fluid" id="mainImage">
            @endif

            @forelse($product->images->take(4) as $image)
                <img src="{{ asset($image->route) }}" alt="{{ $product->name }} - pohľad" class="thumbnail {{ $loop->first ? 'active' : '' }}" onclick="changeImage('{{ asset($image->route) }}', this)">
            @empty
                <img src="{{ asset('images/placeholder.jpg') }}" alt="Žiadny obrázok" class="thumbnail active" onclick="changeImage('{{ asset('images/placeholder.jpg') }}', this)">
            @endforelse
            <!-- doplnenie placeholdermi ak nie je dostatok obrázkov -->
            @if($product->images->count() < 4)
                @for($i = $product->images->count(); $i < 3; $i++)
                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Žiadny obrázok" class="thumbnail" onclick="changeImage('{{ asset('images/placeholder.jpg') }}', this)">
                @endfor
            @endif
        </div>

        <!-- Informácie o produkte -->
        <section class="col-md-6 product-info-column">
            <h1 class="product-name">{{ $product->name }}</h1>
            <p>{{ $product->gender ?? 'Unisex' }}</p> <!-- Predpokladám pole gender, ak neexistuje, použije sa default -->
            <p class="product-price text-success">{{ number_format($product->price, 2) }} €</p>
            <p class="product-description">
                {{ $product->description ?? 'Tento produkt nemá popis.' }}
            </p>

            <!-- Farby -->
            <div class="row">
                <label class="col-1 mt-5 me-4">Farby:</label>
                <div class="color-selection col-5 mt-5" id="color-selection">
                    @if($product->color)
                        @foreach(explode(',', $product->color) as $color)
                            <span class="color-circle" style="background-color: {{ trim($color) }};" aria-label="{{ ucfirst(trim($color)) }}" data-color="{{ trim($color) }}" onclick="selectColor(this)"></span>
                        @endforeach
                    @else
                        <p>Žiadne farby nie sú k dispozícii.</p>
                    @endif
                </div>
            </div>

            <!-- Veľkosti -->
            <label class="mt-3">Veľkosti:</label>
            <div class="row" id="size-selection">
                <div class="col-1"></div>
                @if($product->size)
                    @foreach(explode(',', $product->size) as $size)
                        <div class="size-option" data-size="{{ trim($size) }}" onclick="selectSize(this)">{{ trim($size) }}</div>
                    @endforeach
                @else
                    <p>Žiadne veľkosti nie sú k dispozícii.</p>
                @endif
            </div>

            <form id="add-to-cart-form" action="{{route('cart.add')}}" method="POST">
              @csrf
              <!-- Skryté polia pre farbu a veľkosť -->
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <input type="hidden" name="selected_color" id="selected-color" required>
              <input type="hidden" name="selected_size" id="selected-size" required>
              
              <!-- Množstvo a tlačidlo -->
              <div class="d-flex align-items-center mt-3">
                  <label for="quantity" class="me-3">Množstvo:</label>
                  <input type="number" id="quantity" name="quantity" class="form-control w-25" min="1" value="1" aria-label="Množstvo">
                  <button type="submit" class="btn btn-outline-success ms-3">Pridať do košíka</button>
              </div>
            </form>
        </section>
    </article>
    

    <div class="custom-border mt-3 mb-3"></div>

    <!-- Popis produktu -->
    <section class="mt-3">
        <h2>Popis produktu</h2>
        <p>{{ $product->description ?? 'Žiadny podrobný popis nie je k dispozícii.' }}</p>
    </section>

    <!-- Informácie o výrobcovi -->
    <section>
        <h2>Informácie o výrobcovi</h2>
        <p>{{ $product->manufacturer_info ?? 'Informácie o výrobcovi nie sú dostupné.' }}</p>
    </section>

    <!-- Údaje o výrobku -->
    <section>
        <h2>Údaje o výrobku</h2>
        <ul>
            <li><strong>Typ výrobku:</strong> {{ $product->productinfo ?? 'Není definovaný' }}</li>
            
        </ul>
    </section>
  </main>

  <footer class="container d-flex mt-5 custom-border">
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
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{asset('js/detail_produktu.js')}}" defer></script>
</body>
</html>