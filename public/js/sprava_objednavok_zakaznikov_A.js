//Ak je parameter page rovný 'change_order', presmeruje používateľa na stránku uprava_objednavky_A.html
function changeContent(page) {
    if (page === 'change_order') {
        window.location.href = 'uprava_objednavky_A.html';
    }
}
//Aktualizuje URL pomocou history.pushState, pridáva parameter ?mode=${mode} (napr. ?mode=customers)
function openMode(mode) {
    history.pushState(null, '', `?mode=${mode}`);

    let iconElements = document.querySelectorAll('.dynamic-icon');
    let descriptions = document.querySelectorAll('.order-description');
    let buttons = document.querySelectorAll('.change');
    //podľa módu sa zmenia elementy stránky ako napríklad ikony
    iconElements.forEach(function(iconElement) {
        if (mode === 'customers') {
            iconElement.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>`;
        } else {
            iconElement.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                        </svg>`;
        }
    });
    //zmení sa popis podľa módu stránky
    descriptions.forEach(function(description) {
        if (mode === 'orders') {
            description.textContent = "Popis objednávky";
        } else {
            description.textContent = "Popis zákazníka";
        }
    });
    //upraví sa popis tlačítok podľa módu
    buttons.forEach(function(button) {
        if (mode === 'orders') {
            button.textContent = "Upraviť-Stornovať";
        } else {
            button.textContent = "Zablokovať";
        }
    });
}


window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    const mode = params.get('mode') || 'orders';
    openMode(mode);
};