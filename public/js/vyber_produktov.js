// Funkcia na získanie kategórie z URL
function getCategoryFromURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get('kategoria');
}

// Funkcia na získanie podkategórie z URL
function getSubcategoryFromURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get('podkategoria');
}

// Funkcia na presmerovanie na kategóriu
function openCategory(category) {
    window.location.href = `/kategorie?kategoria=${category}`;
}

// Funkcia na presmerovanie na podkategóriu
function openSubcategory(subcategory) {
    const category = getCategoryFromURL();
    if (category) {
        window.location.href = `/kategorie?kategoria=${category}&podkategoria=${subcategory}`;
    } else {
        window.location.href = `/kategorie?podkategoria=${subcategory}`;
    }
}

// Funkcia na generovanie podkategórií
function generateSubcategories(category) {
    const subcategoryContainer = document.getElementById('subcategory-container');
    subcategoryContainer.innerHTML = ''; // Vyčistíme kontajner

    // Definícia podkategórií pre každú kategóriu
    const subcategoriesMap = {
        'muzi': [
            { id: 'panske-oblecenie', name: 'Pánske oblečenie' },
            { id: 'panska-obuv', name: 'Pánska obuv' },
            { id: 'panske-vybavenie-doplnky', name: 'Pánske vybavenie' }
        ],
        'zeny': [
            { id: 'damske-oblecenie', name: 'Dámske oblečenie' },
            { id: 'damska-obuv', name: 'Dámska obuv' },
            { id: 'damske-vybavenie-doplnky', name: 'Dámske vybavenie' }
        ],
        'deti': [
            { id: 'detske-oblecenie', name: 'Detské oblečenie' },
            { id: 'detska-obuv', name: 'Detská obuv' },
            { id: 'detske-vybavenie-doplnky', name: 'Detské vybavenie' }
        ],
        'sporty': [
            { id: 'futbal', name: 'Futbal' },
            { id: 'basketbal', name: 'Basketbal' },
            { id: 'beh', name: 'Beh' },
            { id: 'cyklistika', name: 'Cyklistika' },
            { id: 'plavanie', name: 'Plávanie' },
            { id: 'tenis', name: 'Tenis' }
        ]
    };

    const subcategories = subcategoriesMap[category] || subcategoriesMap['zeny'];

    subcategories.forEach(subcat => {
        const button = document.createElement('button');
        button.className = 'col-4 col-md-2 category-item custom-link';
        button.textContent = subcat.name;
        button.onclick = () => openSubcategory(subcat.id);
        subcategoryContainer.appendChild(button);
    });
}

// Aktualizácia breadcrumb a generovanie podkategórií
document.addEventListener("DOMContentLoaded", function () {
    const category = getCategoryFromURL();
    const subcategory = getSubcategoryFromURL();

    const categoryMap = {
        "muzi": "Muži",
        "zeny": "Ženy",
        "deti": "Deti",
        "sporty": "Športy"
    };

    const subcategoryMap = {
        "panske-oblecenie": "Pánske oblečenie",
        "panska-obuv": "Pánska obuv",
        "panske-vybavenie-doplnky": "Pánske vybavenie",
        "damske-oblecenie": "Dámske oblečenie",
        "damska-obuv": "Dámska obuv",
        "damske-vybavenie-doplnky": "Dámske vybavenie",
        "detske-oblecenie": "Detské oblečenie",
        "detska-obuv": "Detská obuv",
        "detske-vybavenie-doplnky": "Detské vybavenie",
        "futbal": "Futbal",
        "basketbal": "Basketbal",
        "beh": "Beh",
        "cyklistika": "Cyklistika",
        "plavanie": "Plávanie",
        "tenis": "Tenis"
    };

    generateSubcategories(category);

    const currentCategoryElement = document.getElementById("current-category");
    if (category && categoryMap[category]) {
        if (subcategory && subcategoryMap[subcategory]) {
            currentCategoryElement.innerHTML = `${categoryMap[category]} / ${subcategoryMap[subcategory]}`;
        } else {
            currentCategoryElement.textContent = categoryMap[category];
        }
    } else if (subcategory && subcategoryMap[subcategory]) {
        currentCategoryElement.innerHTML = `${subcategoryMap[subcategory]}`;
    }
});

// Funkcia na filtrovanie cien
function applyPriceFilter() {
    const priceFrom = document.getElementById('priceFrom').value;
    const priceTo = document.getElementById('priceTo').value;
    if (priceFrom && priceTo && Number(priceFrom) <= Number(priceTo)) {
        console.log(`Filtrované ceny: ${priceFrom}€ - ${priceTo}€`);
    } else {
        alert('Prosím, zadaj platný rozsah cien (Od musí byť menšie alebo rovné Do).');
    }
}