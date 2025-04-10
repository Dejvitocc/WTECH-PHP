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
            <!--Hlavné menu-->
            <div class="container  mt-3 d-flex justify-content-center">
                <div class="row align-items-center w-100">
                    <div class="col-lg-2 col-md-2 d-flex justify-content-center">
                        <a href="{{url('/')}}">
                            <img src="{{asset('images/Logo_obchodu.png')}}" alt="Logo stránky" class="logo img-fluid rounded-circle" style="max-height: 100px;">
                        </a>
                    </div>
                </div>
            </div>
        </header>


        <main>
        <!--Nadpis-->
        <section class="container mt-4 border-nadpisu w-50">
            <div class="row text-center">
                <div class="col-12">
                    <h3>
                        Fakturačné údaje - Doprava - Platba
                    </h3>
                </div>
            </div>
        </section>

        <!--Vypĺňanie údajov-->
        <section class="container mt-5">
            <div class="row">
                <div class="col-12 col-md-6 custom-bg">
                    <!--Osobné info-->
                    <form class="container">
                        <div class="row">
                            <div class="col-6 col-md-5">
                                <label for="name" class="form-label">Meno:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="col-6 col-md-5">
                                <label for="surname" class="form-label">Priezvisko:</label>
                                <input type="text" id="surname" name="surname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-7">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="col-6 col-md-5">
                                <label for="phone-number" class="form-label">Tel. číslo:</label>
                                <input type="text" id="phone-number" name="phone-number" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-7">
                                <label for="address" class="form-label">Ulica a číslo domu:</label>
                                <input type="text" id="address" name="address" class="form-control" required>
                            </div>
                            <div class="col-5">
                                <label for="postal" class="form-label">PSČ:</label>
                                <input type="text" id="postal" name="postal" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-7">
                                <label for="city" class="form-label">Mesto:</label>
                                <input type="text" id="city" name="city" class="form-control" required>
                            </div>
                            <div class="col-5">
                                <label for="country" class="form-label">Krajina:</label>
                                <select id="country" name="country" class="form-control" required>
                                    <option value="" disabled selected>Vyberte krajinu</option>
                                    <option value="SK">Slovensko</option>
                                    <option value="CZ">Česká republika</option>
                                    <option value="AT">Rakúsko</option>
                                    <option value="DE">Nemecko</option>
                                    <option value="PL">Poľsko</option>
                                    <option value="HU">Maďarsko</option>
                                    <option value="FR">Francúzsko</option>
                                    <option value="IT">Taliansko</option>
                                    <option value="ES">Španielsko</option>
                                    <option value="GB">Veľká Británia</option>
                                </select>
                            </div>
                        </div>
                    
                        <!--Dopravné spoločnosti/možnosti-->
                        <div class="dropdown mt-3 w-100">
                            <button class="btn btn-light dropdown-toggle w-100" id="deliveryButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Doručenie
                            </button>
                            <ul class="dropdown-menu w-100 text-center">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-center" onclick="changeDeliveryButtonText('Kuriér 1')" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-amazon me-5" viewBox="0 0 16 16">
                                            <path d="M10.813 11.968c.157.083.36.074.5-.05l.005.005a90 90 0 0 1 1.623-1.405c.173-.143.143-.372.006-.563l-.125-.17c-.345-.465-.673-.906-.673-1.791v-3.3l.001-.335c.008-1.265.014-2.421-.933-3.305C10.404.274 9.06 0 8.03 0 6.017 0 3.77.75 3.296 3.24c-.047.264.143.404.316.443l2.054.22c.19-.009.33-.196.366-.387.176-.857.896-1.271 1.703-1.271.435 0 .929.16 1.188.55.264.39.26.91.257 1.376v.432q-.3.033-.621.065c-1.113.114-2.397.246-3.36.67C3.873 5.91 2.94 7.08 2.94 8.798c0 2.2 1.387 3.298 3.168 3.298 1.506 0 2.328-.354 3.489-1.54l.167.246c.274.405.456.675 1.047 1.166ZM6.03 8.431C6.03 6.627 7.647 6.3 9.177 6.3v.57c.001.776.002 1.434-.396 2.133-.336.595-.87.961-1.465.961-.812 0-1.286-.619-1.286-1.533M.435 12.174c2.629 1.603 6.698 4.084 13.183.997.28-.116.475.078.199.431C13.538 13.96 11.312 16 7.57 16 3.832 16 .968 13.446.094 12.386c-.24-.275.036-.4.199-.299z"/>
                                            <path d="M13.828 11.943c.567-.07 1.468-.027 1.645.204.135.176-.004.966-.233 1.533-.23.563-.572.961-.762 1.115s-.333.094-.23-.137c.105-.23.684-1.663.455-1.963-.213-.278-1.177-.177-1.625-.13l-.09.009q-.142.013-.233.024c-.193.021-.245.027-.274-.032-.074-.209.779-.556 1.347-.623"/>
                                        </svg>
                                        <span class="custom-spacing">Kuriér 1</span>
                                        <span>2.99€</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#" onclick="changeDeliveryButtonText('Kuriér 2')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-airplane-fill me-5" viewBox="0 0 16 16">
                                            <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849"/>
                                        </svg>
                                        <span class="custom-spacing">Kuriér 2</span>
                                        <span>3.99€</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#" onclick='changeDeliveryButtonText("Kuriér 3")'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front-fill me-5 " viewBox="0 0 16 16">
                                            <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                                        </svg>
                                        <span class="custom-spacing">Kuriér 3</span>
                                        <span>1.99€</span>

                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--Možnosti platby-->
                        <div class="dropdown mt-3 w-100">
                            <button class="btn btn-light dropdown-toggle  w-100" id="paymentButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Spôsob platby
                            </button>
                            <ul class="dropdown-menu w-100 text-center">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-center" href="#" onclick='changePaymentButtonText("Visa")'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-amazon me-5" viewBox="0 0 16 16">
                                            <path d="M10.813 11.968c.157.083.36.074.5-.05l.005.005a90 90 0 0 1 1.623-1.405c.173-.143.143-.372.006-.563l-.125-.17c-.345-.465-.673-.906-.673-1.791v-3.3l.001-.335c.008-1.265.014-2.421-.933-3.305C10.404.274 9.06 0 8.03 0 6.017 0 3.77.75 3.296 3.24c-.047.264.143.404.316.443l2.054.22c.19-.009.33-.196.366-.387.176-.857.896-1.271 1.703-1.271.435 0 .929.16 1.188.55.264.39.26.91.257 1.376v.432q-.3.033-.621.065c-1.113.114-2.397.246-3.36.67C3.873 5.91 2.94 7.08 2.94 8.798c0 2.2 1.387 3.298 3.168 3.298 1.506 0 2.328-.354 3.489-1.54l.167.246c.274.405.456.675 1.047 1.166ZM6.03 8.431C6.03 6.627 7.647 6.3 9.177 6.3v.57c.001.776.002 1.434-.396 2.133-.336.595-.87.961-1.465.961-.812 0-1.286-.619-1.286-1.533M.435 12.174c2.629 1.603 6.698 4.084 13.183.997.28-.116.475.078.199.431C13.538 13.96 11.312 16 7.57 16 3.832 16 .968 13.446.094 12.386c-.24-.275.036-.4.199-.299z"/>
                                            <path d="M13.828 11.943c.567-.07 1.468-.027 1.645.204.135.176-.004.966-.233 1.533-.23.563-.572.961-.762 1.115s-.333.094-.23-.137c.105-.23.684-1.663.455-1.963-.213-.278-1.177-.177-1.625-.13l-.09.009q-.142.013-.233.024c-.193.021-.245.027-.274-.032-.074-.209.779-.556 1.347-.623"/>
                                        </svg>
                                        <span class="card-spacing">Visa</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#" onclick='changePaymentButtonText("Mastercard")'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-airplane-fill me-5" viewBox="0 0 16 16">
                                            <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849"/>
                                        </svg>
                                        <span class="card-spacing">Mastercard</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#" onclick="changePaymentButtonText('PayPal') ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front-fill me-5 " viewBox="0 0 16 16">
                                            <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                                        </svg>
                                        <span class="card-spacing">PayPal</span>

                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <!--Možnosť ouplatnenia kupónu-->
                        <div class="row mt-3 w-100 mt-2">
                            <div class="col-2 me-3">
                                <label for="kupon" class="form-label">Kupon:</label>
                            </div>
                            <div class="col-6">
                                <input type="text" id="kupon" name="kupon" class="form-control" required>
                            </div>
                            <div class="col-3 mb-2">
                                <div class="btn btn-success">Použiť</div>
                            </div>
                        </div>

                    
                    </form>
                </div>

                <!--Zhrnutie objednavky-->
                <section class="col-12 col-md-6  custom-bg">
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
                        <!--
                        <div class="row">
                            <div class="col-12 mt-5 season-bg">
                                <label class="form-label">Vybraný kuriér: </label>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-12 mt-5 season-bg">
                                <label class="form-label">Súčet: {{ number_format($cartItems->sum(function($item) {
                    return $item->product->price * $item->quantity;
                }), 2) }} €</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-5 text-center">
                                <a href="{{url('/platobna_brana')}}">
                                    <button class="btn btn-success">Objednať s povinnosťou platby</button>
                                </a>
                            </div>
                        </div>


                </section>

            </div>
            
        </section>
        <!--Podpora,obchodné podmienky a iné informácie ohľadom nakupovania-->
        <footer class="container d-flex mt-5 custom-border">
            <div class="row w-100 text-center">
                    <div class=" col-12  col-md-3 col-sm-6 mt-2">
                        <h4>Zákaznícka podpora</h4>
                        <ul  class="no-bullets">
                            <li>Telefónne číslo</li>
                            <li>Pracovné podmienky</li>
                            <li>Email</li>
                        </ul>
                    </div>
                    <div class=" col-12  col-md-3 col-sm-6 mt-2">
                        <h4>Obchodné podmienky</h4>
                        <ul  class="no-bullets">
                            <li>Všeobecné obchodné podmienky</li>
                            <li>Ochrana osobných údajov</li>
                            <li>Cookies</li>
                        </ul>
                    </div>
                    <div class="col-12  col-md-3 col-sm-6 mt-2">
                        <h4>Ako nakupovať</h4>
                        <ul  class="no-bullets">
                            <li>Spôsob platby</li>
                            <li>Spôsob dopravy</li>
                            <li>Výmena a vrátenie</li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 col-sm-6 mt-2">
                        <h4>Služby</h4>
                        <ul  class="no-bullets">
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
    
    <script src="{{asset('js/vytvorenie_objednavky.js')}}" defer></script>
</body>
</html>