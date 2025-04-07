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