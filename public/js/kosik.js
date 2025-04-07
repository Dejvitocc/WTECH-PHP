//odstránenie riadku HTML obsahu na základe ID prvku
function deleteItem(quantityId) {
    const input = document.getElementById(quantityId);
    const row = input.closest('.row');
    row.remove();
}