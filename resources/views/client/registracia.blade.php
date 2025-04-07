<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrácia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #212529;">

<main class="d-flex flex-column justify-content-center align-items-center">
    <div class="text-center mb-4 mt-4">
        <a href="{{url('/')}}">
            <img src="{{asset('images/Logo_obchodu.png')}}" alt="Logo stránky" class="logo img-fluid rounded-circle" style="max-height: 100px;">
        </a>
    </div>
<!--Formulár pre registráciu zákazníka-->
<section class="box p-4 border rounded shadow-sm" style="width: 350px; background-color: #f8f9fa">
    <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">
        <header>
            <h2>Registrácia</h2>
        </header>
    </div>
    <!--Zadávajú sa informácie ako E-mail, krstné meno, priezvisko, heslo, akceptácia zabezpečení a prihlásenie-->
        <form>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Krstné meno:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Priezvisko:</label>
                <input type="text" id="surname" name="surname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Heslo:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="privacyConsent" required>
                <label class="form-check-label" for="privacyConsent">
                    Súhlasím so zásadami ochrany osobných údajov a všeobecnými obchodnými podmienkami
                </label>
            </div>

            <button type="submit" class="btn btn-outline-success w-100">Registrovať sa</button>
        </form>
        <footer class="mt-3">
            <div class="d-flex justify-content-between">
                <a href="{{url('/prihlasenie')}}" class="text-start custom-link">Prihlásiť sa</a>
            </div>
        </footer>
</section>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
