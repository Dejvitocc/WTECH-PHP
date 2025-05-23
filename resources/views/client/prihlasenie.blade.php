<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prihlásenie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #212529;">
<main class="d-flex flex-column justify-content-center align-items-center">
    <div class="text-center mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/Logo_obchodu.png') }}" alt="Logo stránky" class="logo img-fluid rounded-circle" style="max-height: 100px;">
        </a>
    </div>

    <section class="box p-4 border rounded shadow-sm" style="width: 300px; background-color: #f8f9fa">
        <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">
            <header>
                <h2>Prihlásenie</h2>
            </header>
        </div>

        <!-- Zobraz chyby, ak existujú -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Zobraz flash správu, ak existuje -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Heslo:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-outline-success w-100">Prihlásiť sa</button>
        </form>

        <footer class="mt-3">
            <div class="d-flex justify-content-between">
                <a href="{{ url('/zabudnute_heslo') }}" class="text-end custom-link">Zabudli ste heslo?</a>
                <a href="{{ url('/registracia') }}" class="text-start custom-link">Registrácia</a>
            </div>
        </footer>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
