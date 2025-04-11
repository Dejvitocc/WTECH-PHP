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

document.getElementById('coupon-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const couponCode = document.getElementById('kupon').value.toUpperCase();
    const totalElement = document.getElementById('cartTotal');
    const originalTotal = parseFloat(totalElement.dataset.originalTotal);

    const coupons = {
        'SAVE10': 10.00,
        'DISCOUNT20': 20.00,
        'FREESHIP': 5.00
    };

    if (coupons[couponCode]) {
        const newTotal = Math.max(0, originalTotal - coupons[couponCode]);
        totalElement.textContent = newTotal.toFixed(2);
    } else {
        alert('Neplatný kupón.');
    }
});