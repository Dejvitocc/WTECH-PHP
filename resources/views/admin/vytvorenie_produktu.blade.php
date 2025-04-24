<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vytvorenie produktu-Admin časť</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <!--"Hlavička" stránky iba s logom-->
    <div class="container custom-body-bg">
        <header class="container  mt-3 d-flex justify-content-center">
            <div class="row align-items-center w-100">
                <div class="col-lg-2 col-md-2 d-flex justify-content-center">
                    <a href="{{url('/')}}">
                        <img src="{{asset('images/Logo_obchodu.png')}}" alt="Logo stránky" class="logo img-fluid rounded-circle mt-2" style="max-height: 100px;" >
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 d-flex justify-content-center">
                </div>
                <div class="col-lg-4 col-md-4 d-flex justify-content-center"  id="delete-button-container">
                </div>
            </div>
        </header>

        <main>
        <section class="container mt-3 custom-border"></section>
        
        <!--Polia na vyplnenie informácií o produkte pri jeho vytváraní-->
        <!--teda polia ako Názov produktu, id, popis, informácie o výrobcovi, bližšie údaje o výrobku, fotky, hlavné kategórie, podkategórie a cena-->
        <section class="container mt-5 custom-bg">
            <form id="product-form" action="{{ $mode === 'edit' ? route('admin.update', $product->id) : route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($mode === 'edit')
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="name" class="form-label">Meno:</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $mode === 'edit' ? $product->name : '') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">ID produktu:</label><br>
                        <label class="form-label">{{ $mode === 'edit' ? $product->id : 'Automaticky generované' }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <label for="popis" class="form-label">Popis produktu:</label>
                        <textarea id="popis" name="popis" class="form-control" style="min-height: 200px;" required>{{ old('popis', $mode === 'edit' ? $product->description : '') }}</textarea>
                        @error('popis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <label for="vyrobca" class="form-label">Informácie o výrobcovi:</label>
                        <textarea id="vyrobca" name="vyrobca" class="form-control" style="min-height: 200px;" required>{{ old('vyrobca', $mode === 'edit' ? $product->producerinfo : '') }}</textarea>
                        @error('vyrobca')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <label for="udaje" class="form-label">Údaje o výrobku:</label>
                        <textarea id="udaje" name="udaje" class="form-control" style="min-height: 200px;" required>{{ old('udaje', $mode === 'edit' ? $product->productinfo : '') }}</textarea>
                        @error('udaje')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Výber farby a veľkosti -->
                <div class="row">
                    <div class="col-12 col-md-4">
                    <div class="dropdown mb-3">
                        <label class="form-label d-block">Farby:</label>
                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            Vyberte farby
                        </button>
                        <ul class="dropdown-menu dropdown-checkboxes w-100">
                            @foreach($colors as $color)
                                <li class="px-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="colors[]" value="{{ $color->id }}"
                                            id="color-{{ $color->id }}"
                                            @if($mode === 'edit' && $product->colors->contains('id', $color->id))
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="color-{{ $color->id }}">
                                            {{ $color->name }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="dropdown mb-3">
                            <label class="form-label d-block">Veľkosti:</label>
                            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                Vyberte veľkosti
                            </button>
                            <ul class="dropdown-menu dropdown-checkboxes w-100">
                                @foreach($sizes as $size)
                                    <li class="px-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="sizes[]" value="{{ $size->id }}"
                                                id="size-{{ $size->id }}"
                                                @if($mode === 'edit' && $product->sizes->contains('id', $size->id))
                                                    checked
                                                @endif>
                                            <label class="form-check-label" for="size-{{ $size->id }}">
                                                {{ $size->name }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" id="product-id" value="{{ $product->id ?? '' }}">

                <!-- Nahrávanie obrázkov -->
                <div class="row">
                    <div class="col-12 col-md-8">
                        <label class="form-label">Fotografia:</label>
                        <input type="file" name="images[]" id="image-upload" class="form-control" multiple accept="image/*">
                        @error('images')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Fotky pre produkt pričom má možnosť odstránenia pomocou X -->
                <div class="row-50 mt-1" id="image-container">
                    @if($mode === 'edit')
                        @if($product->images->isNotEmpty())
                            @foreach($product->images as $image)
                                <article class="image-wrapper">
                                    <img src="{{ asset($image->route) . '?v=' . time() }}" alt="Produkt" class="logo img-fluid rounded-circle" style="max-height: 100px;">
                                    <span class="delete-icon" data-image-id="{{ $image->id }}">✖</span>
                                </article>
                            @endforeach
                        @endif
                    @endif
                </div>

                <!-- Výber kategórií a podkategórií -->
                <div class="row mt-4">
                    <div class="col-12 col-md-4 me-2">
                        <label for="category_id" class="form-label">Hlavné kategórie:</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">Vyberte kategóriu</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if($mode === 'edit' && $product->categories->contains('id', $category->id))
                                        selected
                                    @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="subcategory_id" class="form-label">Podkategórie:</label>
                        <select id="subcategory_id" name="subcategory_id" class="form-control" required>
                            <option value="">Vyberte podkategóriu</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"
                                    @if($mode === 'edit' && $product->subcategories->contains('id', $subcategory->id))
                                        selected
                                    @endif>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Cena produktu -->
                <div class="row mt-5 mb-5">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Cena:</label>
                        <input type="text" id="cena" name="cena" class="form-control" value="{{ old('cena', $mode === 'edit' ? $product->price : '') }}" required>
                        @error('cena')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Množstvo:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $mode === 'edit' ? $product->stockquantity : '') }}" required>
                        @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row"></div>
            </form>
        </section>

        <!-- Tlačítka pre vytvorenie produktu a návrat na správu produktov -->
        <section class="container mt-3 mb-3">
            <div class="row w-100">
                <div class="col-12 col-md-4 align-items-center justify-content-center">
                    <a href="{{ route('admin.index') }}">
                        <button type="button" class="btn btn-dark w-100">←Naspäť</button>
                    </a>
                </div>
                <div class="col-12 col-md-4 mt-2 mb-2"></div>
                <div class="col-12 col-md-4 align-items-center justify-content-center">
                    <button type="submit" form="product-form" class="btn btn-success w-100">
                        {{ $mode === 'edit' ? 'Upraviť' : 'Vytvoriť' }}
                    </button>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="row"></div>
        </section>
    </main>
    </div>


    
    
    
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/vytvorenie_produktu_A.js') }}" defer></script>


</body>
</html>