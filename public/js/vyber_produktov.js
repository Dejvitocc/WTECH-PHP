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

// Validácia a formátovanie cien
document.getElementById('priceFilterForm').addEventListener('submit', function(event) {
    // Načítanie hodnôt ako reťazcov
    const priceFromInput = document.getElementById('priceFrom').value.trim();
    const priceToInput = document.getElementById('priceTo').value.trim();

    // Prevod hodnôt na čísla, ak nie sú prázdne
    const priceFrom = priceFromInput ? parseFloat(priceFromInput.replace(',', '.')) : null;
    const priceTo = priceToInput ? parseFloat(priceToInput.replace(',', '.')) : null;

    // console.log('Price From:', priceFrom);
    // console.log('Price To:', priceTo);

    // Validácia: Ak hodnota nie je prázdna, musí byť číselná
    if (priceFromInput && (isNaN(priceFrom) || priceFromInput.match(/[^0-9.,]/))) {
        event.preventDefault();
        alert('Hodnota "Od" musí byť platné číslo (napr. 10.50).');
        return false;
    }
    if (priceToInput && (isNaN(priceTo) || priceToInput.match(/[^0-9.,]/))) {
        event.preventDefault();
        alert('Hodnota "Do" musí byť platné číslo (napr. 50.99).');
        return false;
    }

    // Validácia: Ak sú obe hodnoty zadané, skontroluj, či priceFrom nie je väčšie ako priceTo
    if (priceFrom !== null && priceTo !== null && priceFrom > priceTo) {
        event.preventDefault();
        alert('Hodnota "Od" nemôže byť väčšia ako hodnota "Do".');
        return false;
    }

    // Validácia: Skontroluj, či nie sú zadané záporné hodnoty
    if (priceFrom !== null && priceFrom < 0) {
        event.preventDefault();
        alert('Hodnota "Od" nemôže byť záporná.');
        return false;
    }
    if (priceTo !== null && priceTo < 0) {
        event.preventDefault();
        alert('Hodnota "Do" nemôže byť záporná.');
        return false;
    }

});

// Formátovanie vstupu na 2 desatinné miesta pri odchode z poľa
document.getElementById('priceFrom').addEventListener('blur', function() {
    const value = this.value.trim();
    if (value) {
        const num = parseFloat(value.replace(',', '.'));
        if (!isNaN(num)) {
            this.value = num.toFixed(2); // Zaokrúhli na 2 desatinné miesta
        }
    }
});

document.getElementById('priceTo').addEventListener('blur', function() {
    const value = this.value.trim();
    if (value) {
        const num = parseFloat(value.replace(',', '.'));
        if (!isNaN(num)) {
            this.value = num.toFixed(2); // Zaokrúhli na 2 desatinné miesta
        }
    }
});

// Validácia vyhľadávacieho formulára
document.getElementById('search-form').addEventListener('submit', function(event) {
    const searchInput = document.querySelector('input[name="search"]').value.trim();
    if (!searchInput) {
        event.preventDefault();
        alert('Zadajte názov produktu!');
    }
});
