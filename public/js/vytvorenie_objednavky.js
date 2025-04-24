function changeDeliveryButtonText(selectedOption, deliveryPrice) {
    var button = document.getElementById('deliveryButton');
    button.innerHTML = selectedOption;

    // Fallback for delivery price
    if (isNaN(parseFloat(deliveryPrice))) {
        var selectedItem = document.querySelector(`.dropdown-item[onclick*="${selectedOption}"]`);
        deliveryPrice = parseFloat(selectedItem.getAttribute('data-price')) || 0;
    } else {
        deliveryPrice = parseFloat(deliveryPrice) || 0;
    }

    // Handle comma-separated prices
    deliveryPrice = parseFloat(String(deliveryPrice).replace(',', '.')) || 0;

    // Store delivery option and price
    var deliveryOptionInput = document.getElementById('delivery_option');
    var deliveryPriceInput = document.getElementById('delivery_price');
    deliveryOptionInput.value = selectedOption;
    deliveryPriceInput.value = deliveryPrice;

    // Update cart total
    var cartTotalElement = document.getElementById('cartTotal');
    var originalTotal = parseFloat(cartTotalElement.getAttribute('data-original-total'));
    var newTotal = originalTotal + deliveryPrice;
    cartTotalElement.textContent = `Celková suma: ${newTotal.toFixed(2)}`;
    document.getElementById('total_amount').value = newTotal.toFixed(2);
}
function changePaymentButtonText(selectedMethod) {
    var button = document.getElementById('paymentButton');
    button.innerHTML = selectedMethod;
    var paymentMethodInput = document.getElementById('payment_method');
    paymentMethodInput.value = selectedMethod;

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
        totalElement.textContent = `Celková suma: ${newTotal.toFixed(2)}`;
    } else {
        alert('Neplatný kupón.');
    }
});

// Form validation before submission
document.getElementById('orderForm').addEventListener('submit', function(event) {
    var deliveryOption = document.getElementById('delivery_option').value;
    var paymentMethod = document.getElementById('payment_method').value;

    if (!deliveryOption) {
        event.preventDefault();
        alert('Prosím, vyberte spôsob doručenia.');
        return;
    }

    if (!paymentMethod) {
        event.preventDefault();
        alert('Prosím, vyberte spôsob platby.');
        return;
    }
});
