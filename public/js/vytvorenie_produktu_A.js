document.addEventListener('DOMContentLoaded', function () {
    const isEditMode = window.location.pathname.includes('/admin/edit');
    const mode = isEditMode ? 'edit' : 'create';

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
    const imageContainer = document.getElementById('image-container');
    const productIdInput = document.getElementById('product-id');

    // Predvyplnenie polí v edit móde
    if (mode === 'edit') {

        const productId = productIdInput.value;
        const deleteButton = document.createElement('button');
        deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'w-100');
        deleteButton.textContent = 'Zmazať produkt';
        deleteButton.onclick = function () {
            const confirmed = confirm('Naozaj chcete zmazať tento produkt?');
            console.log('Confirm result:', confirmed);
            if (confirmed) {
                console.log('Sending DELETE request for product ID:', productId);
                fetch(`/admin/products/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    console.log('Delete response status:', response.status, 'Response:', response);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Delete response data:', data);
                    window.location.href = '/admin';
                })
                .catch(error => {
                    console.error('Chyba pri mazaní:', error);
                    alert('Chyba pri mazaní produktu: ' + error.message);
                });
            }
        };
        if (deleteButtonContainer) {
            deleteButtonContainer.appendChild(deleteButton);
        } else {
            console.error('Delete button container not found');
        }
    } else {
        createButton.textContent = 'Vytvoriť';
        nameInput.value = '';
        popisTextarea.value = '';
        cenaInput.value = '';
    }

    if (imageContainer) {
        imageContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-icon')) {
                console.log('Delete icon clicked', { imageId: e.target.dataset.imageId }); // Debugging
                const imageWrapper = e.target.closest('.image-wrapper');
                const imageId = e.target.dataset.imageId;

                if (imageId && isEditMode) {
                    if (confirm('Naozaj chcete odstrániť tento obrázok?')) {
                        fetch(`/admin/images/${imageId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                        })
                            .then(response => {
                                if (response.ok) {
                                    imageWrapper.remove(); // 🧹 Odstráni element z DOM
                                } else {
                                    alert('Chyba pri mazaní obrázka.');
                                }
                            })
                            .catch(error => {
                                console.error('Chyba:', error);
                                alert('Chyba pri mazaní obrázka.');
                            });
                    }
                } else {
                    console.log('Removing new image locally'); // Debugging
                    imageWrapper.remove(); // Lokálne odstránenie pre nové obrázky
                }
            }
        });
    } else {
        console.warn('Image container not found'); // Debugging
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category');
    const subcategorySelect = document.getElementById('subcategory');

    // Funkcia na aktualizáciu podkategórií
    function updateSubcategories() {
        const selectedCategory = categorySelect.value;
        const subcategoryOptions = subcategorySelect.querySelectorAll('option');

        subcategoryOptions.forEach(option => {
            if (option.value === '') {
                option.style.display = 'block'; // Vždy zobraziť "Vyberte podkategóriu"
            } else if (option.dataset.category === selectedCategory) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });

        // Reset podkategórie, ak nevyhovuje aktuálnej kategórii
        if (subcategorySelect.value && !subcategorySelect.querySelector(`option[value="${subcategorySelect.value}"][data-category="${selectedCategory}"]`)) {
            subcategorySelect.value = '';
        }
    }

    // Inicializácia podkategórií pri načítaní
    updateSubcategories();

    // Aktualizácia podkategórií pri zmene kategórie
    categorySelect.addEventListener('change', updateSubcategories);
});

