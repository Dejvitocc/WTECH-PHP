<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zabudnuté heslo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #212529;">

<main class="d-flex flex-column justify-content-center align-items-center">
    <div class="text-center mb-4">
        <a href="{{url('/')}}">
            <img src="{{asset('images/Logo_obchodu.png')}}" alt="Logo stránky" class="logo img-fluid rounded-circle" style="max-height: 100px;">
        </a>
    </div>

    <div class="box p-4 border rounded shadow-sm" style="width: 300px; background-color: #f8f9fa">
        <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">
            <header>
                <h2>Zabudnuté heslo</h2>
            </header>
        </div>
        <section>
            Zadajte svoju e-mailovú adresu na zaslanie obnovujúceho mailu.
        </section>
        <section>
            <form>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" id="email" name="emial" class="form-control" required>
                </div>

                <button type="submit" class="mb-3 mt-3 btn btn-outline-success w-100">Zaslať obnovujúci e-mail</button>
                <a href="{{url('/prihlasenie')}}" class="custom-link">Späť</a>
            </form>
        </section>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
