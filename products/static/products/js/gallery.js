document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.getElementById('product-table-body');

    // Event Delegation: one listener for all the buttons in the table
    tableBody.addEventListener('click', (e) => {
        const btn = e.target.closest('.gallery-toggle-btn');
        if (!btn) return;

        const row = btn.closest('.product-row');
        const productId = row.dataset.id;
        
        toggleGallery(btn, productId, row);
    });
});

function toggleGallery(btn, productId, currentRow) {
    const nextRow = currentRow.nextElementSibling;
    const btnText = btn.querySelector('span');

    // close the open gallery
    if (nextRow && nextRow.classList.contains('gallery-row')) {
        nextRow.remove();
        btnText.textContent = 'Gallery';
        btn.className = 'gallery-toggle-btn inline-flex items-center bg-gray-800 text-white px-4 py-1 rounded text-sm hover:bg-gray-700 transition-all min-w-[80px] justify-center';
        return;
    }

    // get the images from the hidden JSON (Django created it securely)
    const scriptData = document.getElementById(productId);
    if (!scriptData) return;
    const images = JSON.parse(scriptData.textContent).slice(0, 3);

    // create elements in a secure way (without innerHTML)
    const galleryRow = document.createElement('tr');
    galleryRow.className = 'gallery-row bg-gray-50 border-b border-gray-200 fade-in';
    
    const td = document.createElement('td');
    td.setAttribute('colspan', '6');
    td.className = 'p-6';

    const container = document.createElement('div');
    container.className = 'flex gap-6 justify-center';

    images.forEach(imgUrl => {
        const img = document.createElement('img');
        img.src = imgUrl;
        img.className = 'w-40 h-40 object-cover rounded-lg shadow-md border-2 border-white hover:scale-105 transition-transform';
        img.alt = 'Product image';
        container.appendChild(img);
    });

    td.appendChild(container);
    galleryRow.appendChild(td);
    currentRow.parentNode.insertBefore(galleryRow, currentRow.nextSibling);

    // update the button text
    btnText.textContent = 'Close';
    btn.className = 'gallery-toggle-btn inline-flex items-center bg-red-600 text-white px-4 py-1 rounded text-sm hover:bg-red-700 transition-all min-w-[80px] justify-center';
}