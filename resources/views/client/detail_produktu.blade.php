<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail produktu - Športový e-shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <style>
    .thumbnail {
      width: 80px;
      height: 80px;
      object-fit: cover;
      cursor: pointer;
      margin-bottom: 10px;
      border: 2px solid transparent;
      transition: border 0.3s;
    }
    .thumbnail:hover, .thumbnail.active {
      border: 2px solid #007bff;
    }
    .main-image {
      width: 100%;
      height: auto;
      object-fit: contain;
    }
  </style>
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
        <form class="d-flex w-100 justify-content-center" role="search">
          <input type="search" class="form-control form-control-sm text-center me-2" placeholder="Zadajte názov produktu..." aria-label="Vyhľadávanie">
          <button class="btn btn-dark btn-sm" type="submit">Hľadať</button>
        </form>
      </div>
      <div class="col-lg-2 col-md-3 d-flex justify-content-center">
        <a href="{{url('/prihlasenie')}}"><button class="btn btn-dark btn-sm me-1">Prihlásenie</button></a>
        <a href="{{url('/kosik')}}"><button class="btn btn-dark btn-sm">Košík</button></a>
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
      <aside class="col-md-1 d-flex flex-column align-items-center">
        <img src="{{asset('images/teniska1.jpg')}}" alt="Teniska pohľad 1" class="thumbnail active" onclick="changeImage('{{asset('images/teniska1.jpg')}}', this)">
        <img src="{{asset('images/batoh.jpg')}}" alt="Batoh" class="thumbnail" onclick="changeImage('{{asset('images/batoh.jpg')}}', this)">
        <img src="{{asset('images/teniska1.jpg')}}" alt="Teniska pohľad 2" class="thumbnail" onclick="changeImage('{{asset('images/teniska1.jpg')}}', this)">
        <img src="{{asset('images/teniska1.jpg')}}" alt="Teniska pohľad 3" class="thumbnail" onclick="changeImage('{{asset('images/teniska1.jpg')}}', this)">
      </aside>

      <div class="col-md-5">
        <img src="{{asset('images/teniska1.jpg')}}" alt="Hlavný obrázok bežeckých tenisiek" class="main-image img-fluid" id="mainImage">
      </div>

      <section class="col-md-6">
        <h1 class="product-name">Bežecké tenisky</h1>
        <p>Ženy</p>
        <p class="product-price text-success">59.99 €</p>
        <p class="product-description">
          Tento produkt je ideálny pre každého, kto hľadá kvalitu a výkon. Vhodný na...
        </p>
        <div class="row">
          <label class="col-1 mt-5 me-4">Farby:</label>
          <div class="color-selection col-5 mt-5">
            <span class="color-circle" style="background-color: red;" aria-label="Červená"></span>
            <span class="color-circle" style="background-color: blue;" aria-label="Modrá"></span>
            <span class="color-circle" style="background-color: green;" aria-label="Zelená"></span>
            <span class="color-circle" style="background-color: yellow;" aria-label="Žltá"></span>
          </div>
        </div>
        <label class="mt-3">Veľkosť:</label>
        <div class="row">
          <div class="col-1"></div>
          <div class="size-option">40</div>
          <div class="size-option">41</div>
          <div class="size-option">42</div>
          <div class="size-option">43</div>
        </div>
        <div class="row">
          <div class="col-1"></div>
          <div class="size-option">40</div>
          <div class="size-option">41</div>
          <div class="size-option">42</div>
          <div class="size-option">43</div>
        </div>
        <div class="d-flex align-items-center mt-3">
          <label for="quantity" class="me-3">Množstvo:</label>
          <input type="number" id="quantity" class="form-control w-25" min="1" value="1" aria-label="Množstvo">
          <button class="btn btn-outline-success ms-3">Pridať do košíka</button>
        </div>
      </section>
    </article>

    <div class="custom-border mt-3 mb-3"></div>

    <section class="mt-3">
      <h2>Popis produktu</h2>
      <p>
        Bežecké tenisky sú ideálnym partnerom pre každú ženu, ktorá si potrpí na pohodlie,
        podporu a výkon pri behu. Tieto tenisky sú navrhnuté s dôrazom na komfort a flexibilitu...
      </p>
    </section>
    <section>
      <h2>Informácie o výrobcovi</h2>
      <p>
        Značka sa špecializuje na výrobu kvalitného športového vybavenia, ktoré je navrhnuté s ohľadom na výkon...
      </p>
    </section>
    <section>
      <h2>Údaje o výrobku</h2>
      <ul>
        <li><strong>Typ výrobku:</strong> Bežecké tenisky pre ženy</li>
        <li><strong>Materiál:</strong> Syntetická tkanina, guma, EVA pena</li>
        <li><strong>Vhodné na:</strong> Behanie, fitness tréning, každodenné použitie</li>
        <li><strong>Technológie:</strong> Tlmenie nárazov, priedušná sieťovina, flexibilná podrážka</li>
        <li><strong>Farba:</strong> Čierna, ružová, biela</li>
        <li><strong>Veľkosti:</strong> 36-42</li>
        <li><strong>Hmotnosť:</strong> 250 g (veľkosť 39)</li>
        <li><strong>Záruka:</strong> 2 roky</li>
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