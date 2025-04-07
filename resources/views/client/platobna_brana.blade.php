<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platobná brána</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="with-background">
    
    <main class="d-flex justify-content-center align-items-center mt-5  vh-100">
        <section class="p-4 shadow-sm payment-bg rounded-4">
            <h3 class="text-center mb-4">Payment Information</h3>
            <form action="#" method="POST">

                <!-- Karta -->
                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Číslo karty</label>
                    <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9101 1121" required maxlength="19" inputmode="numeric">
                </div>

                <!-- dátum expirácie a CVV -->
                <div class="mb-3 d-flex justify-content-between">
                    <div class="me-3 w-50">
                        <label for="expirationMonth" class="form-label">Expirácia</label>
                        <select id="expirationMonth" class="form-select" required>
                            <option value="">Month</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="me-3 w-50">
                        <label for="expirationYear" class="form-label"></label>
                        <select id="expirationYear" class="form-select mt-2" required>
                            <option value="">Year</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                    <div class="w-25">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" placeholder="123" required maxlength="3" inputmode="numeric">
                    </div>
                </div>

                <!-- Zaplatiť button-->
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success w-100" onclick="window.location.href='{{url('/')}}'">Zaplatiť</button>
                </div>
            </form>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>