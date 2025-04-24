<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Správa produktov-Admin časť</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Hlavička admin časti-->
    <div class="container custom-body-bg">
        <header class="container  mt-3 d-flex justify-content-center">
            <div class="row align-items-center w-100">
                <div class="col-lg-2 col-md-2 d-flex justify-content-center">
                    <a href="{{url('/')}}">
                        <img src="{{asset('images/Logo_obchodu.png')}}" alt="Logo stránky" class="logo img-fluid rounded-circle" style="max-height: 100px;">
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 d-flex justify-content-center">
                </div>
                <div class="col-lg-2 col-md-2 d-flex justify-content-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-light">Odhlásiť</button>
                    </form>
                </div>
            </div>
        </header>

        <!--Buttony na prepinanie produkty-objednavky-zakaznici
        <nav class="container mt-3 custom-border">
            <div class="row mt-3 justify-content-center w-100">
                <div class="col-12 col-md-4 mt-1">
                    <button class="btn v_btn btn-outline-dark btn-lg  w-100 small-font" onclick="">Správa produktov</button>
                    
                </div>
                <div class="col-12 col-md-4 mt-1">
                    <button class="btn v_btn btn-outline-dark btn-lg  w-100 small-font" onclick="window.location.href = 'sprava_objednavok_zakaznikov_A.html?mode=orders'">Správa objednávok</button>
                </div>
                <div class="col-12 col-md-4 mt-1">
                    <button class="btn v_btn btn-outline-dark btn-lg  w-100 small-font" onclick="window.location.href = 'sprava_objednavok_zakaznikov_A.html?mode=customers'">Správa zákazníkov</button>
                </div>
            </div>
        </nav>
        -->

        <main>
        <!--Tlačítko na vytvorenie nového produktu-->
        <section class="container mt-4">
            <div class="row">
                <div class="col-12 col-md-4">
                    <a href="{{ route('admin.create') }}?mode=create">
                        <button class="btn v_btn btn-dark btn-lg  w-100">Pridať produkt</button>
                    </a>
                </div>
                <div class="col-12 col-md-1"></div>
                <div class="col-12 col-md-7 mt-2">
                    <form method="GET" action="{{ route('admin.index') }}">
                        <input type="text" name="search" class="form-control form-control-sm text-center w-100" placeholder="Zadajte názov produktu ... " value="{{ request('search') }}">
                    </form>
                </div>
            </div>
        </section>

        <!--Tabulka produktov-->
        <section class="container custom-bg mt-3 mb-5">
        @foreach($products as $product)
            <article class="row w-100 d-flex justify-content-center align-items-center custom-border mb-2">
                <div class="col-4 d-flex justify-content-center mt-1">
                    @if($product->images->isNotEmpty())
                        <img src="{{ asset($product->images->first()->route) }}" alt="{{ $product->name }}" class="small-images img-fluid" id="mainImage">
                    @else
                        <img src="{{ asset('images/placeholder.jpg') }}" alt="Žiadny obrázok" class="small-images img-fluid" id="mainImage">
                    @endif
                </div>

                <div class="col-5 d-flex justify-content-evenly align-items-center">
                    <div>
                        <small>{{$product->id}}</small>
                        <small>{{ $product->name }}</small>
                        <small class="text-muted">{{ $product->price }} €</small>
                    </div>
                </div>

                <div class="col-3 text-center">
                    <a href="{{route('admin.edit', $product->id) }}" class="btn v_btn btn-link custom-link w-100">Upraviť -Zmazať</a>
                </div>
            </article>
        @endforeach
        </section>

        <!-- Prepínanie medzi viacerými stránkami produktov -->
        <nav aria-label="Page navigation" class="mt-2">
            <ul class="pagination justify-content-center">
            {{ $products->appends(['search' => request('search')])->links('bootstrap-5') }}
            </ul>
        </nav>

        </main>
        <div class="container">
            <div class="row"></div>
        </div>

    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>