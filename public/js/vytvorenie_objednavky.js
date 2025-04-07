function changeDeliveryButtonText(selectedOption) {
    // Získaj tlačidlo podľa jeho ID a nastav nový text
    var button = document.getElementById('deliveryButton');
    button.innerHTML = selectedOption;
}

function changePaymentButtonText(selectedOption) {
    // Získaj tlačidlo podľa jeho ID a nastav nový text
    var button = document.getElementById('paymentButton');
    button.innerHTML = selectedOption;
}