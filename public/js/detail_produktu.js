function getCategoryFromURL() { //extrahovanie kategórie z URL adresy
    const params = new URLSearchParams(window.location.search);
    return params.get('kategoria');
}
//po načítaní stránky sa získa kategória pomocou getCategoryFromURL()
//a podľa vybranej kaegórie sa zobrazí v detaili produktu v akej kategorii sa nachádzame
document.addEventListener("DOMContentLoaded", function () {
    const category = getCategoryFromURL();
    const categoryMap = {
        "muzi": "Muži",
        "zeny": "Ženy",
        "deti": "Deti",
        "sporty": "Športy"
    };

    if (category && categoryMap[category]) {
        document.getElementById("current-category").textContent = categoryMap[category];
    }
});
//Presmerovanie používateľa na stránku výberu produktov s danou kategóriou
function openCategory(category) {
    window.location.href = `/kategorie?kategoria=${category}`;
}

// Funkcia na zmenu hlavného obrázka odstráni triedu active zo všetkých miniatúr 
// a pridanie triedy active na zvolenej miniatúre
function changeImage(imageSrc, thumbnail) {
    document.getElementById('mainImage').src = imageSrc;
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    thumbnail.classList.add('active');
}

document.getElementById('search-form').addEventListener('submit', function(event) {
    const searchInput = document.querySelector('input[name="search"]').value.trim();
    if (!searchInput) {
        event.preventDefault(); // Zastaví odoslanie, ak je pole prázdne
        alert('Zadajte názov produktu!');
    }
});

function selectColor(element) {
    // Odstrániť "selected" triedu zo všetkých farieb
    document.querySelectorAll('.color-circle').forEach(circle => {
        circle.classList.remove('selected');
    });
    
    // Pridať "selected" triedu na kliknutú farbu
    element.classList.add('selected');
    
    // Aktualizovať skryté pole s vybranou farbou
    document.getElementById('selected-color').value = element.getAttribute('data-color');
}

function selectSize(element) {
    // Odstrániť "selected" triedu zo všetkých veľkostí
    document.querySelectorAll('.size-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    // Pridať "selected" triedu na kliknutú veľkosť
    element.classList.add('selected');
    
    // Aktualizovať skryté pole s vybranou veľkosťou
    document.getElementById('selected-size').value = element.textContent.trim();
}

//overenie či dal zákazník farbu aj veľkosť
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('add-to-cart-form');

    form.addEventListener('submit', function (e) {
      const selectedColor = document.getElementById('selected-color').value;
      const selectedSize = document.getElementById('selected-size').value;

      if (!selectedColor || !selectedSize) {
        e.preventDefault(); // Zastaví odoslanie formulára
        alert('Prosím, vyberte farbu a veľkosť produktu.');
      }
    });
  });