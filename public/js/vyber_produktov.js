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

    // Aktualizovaná definícia podkategórií podľa databázy
    const subcategoriesMap = {
        'muzi': [
            { id: 1, name: 'Oblečenie' },
            { id: 2, name: 'Obuv' },
            { id: 3, name: 'Vybavenie' }
        ],
        'zeny': [
            { id: 1, name: 'Oblečenie' },
            { id: 2, name: 'Obuv' },
            { id: 3, name: 'Vybavenie' }
        ],
        'deti': [
            { id: 1, name: 'Oblečenie' },
            { id: 2, name: 'Obuv' },
            { id: 3, name: 'Vybavenie' }
        ],
        'sporty': [
            { id: 4, name: 'Futbal' },
            { id: 5, name: 'Basketbal' },
            { id: 6, name: 'Beh' },
            { id: 7, name: 'Cyklistika' },
            { id: 8, name: 'Plávanie' },
            { id: 9, name: 'Tenis' }
        ]
    };

    const subcategories = subcategoriesMap[category] || [];

    subcategories.forEach(subcat => {
        const button = document.createElement('button');
        button.className = 'col-12 col-md-2 category-item custom-link';
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
        1: "Oblečenie",
        2: "Obuv",
        3: "Vybavenie",
        4: "Futbal",
        5: "Basketbal",
        6: "Beh",
        7: "Cyklistika",
        8: "Plávanie",
        9: "Tenis"
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

document.getElementById('search-form').addEventListener('submit', function(event) {
    const searchInput = document.querySelector('input[name="search"]').value.trim();
    if (!searchInput) {
        event.preventDefault();
        alert('Zadajte názov produktu!');
    }
});