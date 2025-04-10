
document.getElementById('search-form').addEventListener('submit', function(event) {
    const searchInput = document.querySelector('input[name="search"]').value.trim();
    if (!searchInput) {
        event.preventDefault(); // Zastaví odoslanie, ak je pole prázdne
        alert('Zadajte názov produktu!');
    }
});

function updateQuantity(button, change) {
    const form = button.closest('form');
    const input = form.querySelector('input[name="quantity"]');
    let value = parseInt(input.value) + change;
    if (value < 1) value = 1;
    input.value = value;
    form.submit();
}