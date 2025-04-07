document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const mode = urlParams.get('mode');

    // Referencie na polia
    const nameInput = document.getElementById('name');
    const popisTextarea = document.getElementById('popis');
    const vyrobcaTextarea = document.getElementById('výrobca');
    const udajeProduktuTextarea = document.getElementById('údaje');
    const farbaSelect = document.getElementById('color');
    const sizeInput = document.getElementById('size');
    const cenaInput = document.getElementById('cena');
    const createButton = document.querySelector('.btn-success');
    const deleteButtonContainer = document.getElementById('delete-button-container');

    // Predvyplnenie polí v edit móde
    if (mode === 'edit') {
        const farba = "red";
        createButton.textContent = 'Upraviť';
        nameInput.value = 'Príklad produktu';
        popisTextarea.value = 'Toto je príklad popisu produktu.';
        vyrobcaTextarea.value = 'Toto je príklad informácii o výrobcovi.';
        udajeProduktuTextarea.value = 'Toto je príklad ďalších údajov o výrobku.';
        farbaSelect.value = farba;
        sizeInput.value = '42';
        cenaInput.value = '99,99';

        const deleteButton = document.createElement('button');
        deleteButton.classList.add('btn', 'btn-danger', 'btn-sm','w-100');
        deleteButton.textContent = 'Zmazať produkt';
        deleteButton.onclick = function () {
            if (confirm('Naozaj chcete zmazať tento produkt?')) {
                alert('Produkt bol zmazaný.');
                window.location.href = 'sprava_produktov_A.html';
            }
        };
        deleteButtonContainer.appendChild(deleteButton);
    } else {
        createButton.textContent = 'Vytvoriť';
        nameInput.value = '';
        popisTextarea.value = '';
        cenaInput.value = '';
    }

    // Funkcionalita na odstraňovanie obrázkov
    const imageContainer = document.getElementById('image-container');
    imageContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-icon')) {
            const imageWrapper = e.target.closest('.image-wrapper');
            imageWrapper.remove(); // Odstráni celý wrapper s obrázkom
        }
    });
});