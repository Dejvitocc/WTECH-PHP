document.addEventListener('DOMContentLoaded', function () { 
    // Vyhľadáme všetky karusely na stránke
    var carousels = document.querySelectorAll('.carousel');
    
    // Pre každý karusel vykonáme manipuláciu s položkami individuálne
    carousels.forEach(carousel => {
        // Vyberieme všetky položky v rámci aktuálneho karuselu
        var items = carousel.querySelectorAll('.carousel .carousel-item');
        
        // Definujeme, koľko položiek sa má klonovať
        const slide = 4;
        
        // Pre každú položku karuselu
        items.forEach((e) => {
            let next = e.nextElementSibling;
            
            // Klonujeme položky a pridávame ich k aktuálnemu prvku
            for (var i = 0; i < slide; i++) {
                if (!next) {
                    next = items[0]; // Ak neexistuje ďalší súrodenec (next), vráti sa na prvý prvok (items[0])
                }
                let cloneChild = next.cloneNode(true); // Vytvorí sa kópia nasledujúceho prvku
                e.appendChild(cloneChild.children[0]); // Pridá kópiu do aktuálneho prvku
                next = next.nextElementSibling; // Posunie sa na nasledujúceho súrodenca
            }
        });

        // Pre každý carousel sa spočíta počet itemov vnútri
        const carouselInner = carousel.querySelector('.carousel-inner');
        const totalItems = carouselInner.querySelectorAll('.carousel-item').length;

        // Ak je iba jeden carousel-item, pridá sa trieda single-item na carousel-inner
        // Toto slúži na špeciálnu úpravu štýlu pre karusel s jednou položkou
        if (totalItems === 1) {
            carouselInner.classList.add('single-item');
        }
    });
});
//Funkcia presmeruje používateľa na stránku vyber_produktov.html
function openCategory(category) {
    window.location.href = `/kategorie?kategoria=${category}`;
}