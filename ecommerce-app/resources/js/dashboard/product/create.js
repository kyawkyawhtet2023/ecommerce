document.getElementById('create-cancel').addEventListener('click', function() {
    
    window.history.back();
});

document.getElementById('product-btn').addEventListener('submit', function() {
    
    const button = this;
    button.textContent = 'Loading...'; 
    button.disabled = true; 
});





let itemCounter = 1;
document.getElementById('add-item').addEventListener('click', function() {
    const itemBox = document.getElementById('item-box');
    const itemGroup = document.createElement('div');
    const sku = 'SKU-' + Date.now();
    const barcode = Date.now().toString().slice(-6) + Math.floor(Math.random() * 900000 + 100000);
    itemGroup.className = 'item-group';

    itemCounter++;

    itemGroup.innerHTML = `
        <div class="new-item">
            <div class="img-group">
                <label for="item-image-${itemCounter}">
                    <input type="file" accept="image/*" name="image[]" id="item-image-${itemCounter}" onchange="previewImage(event, 'item-${itemCounter}')" required>
                    <img class="item-img" src="${defaultImagePath}" id="item-${itemCounter}"> Image
                </label>
            </div>
            <div class="detail-group">
                <div class="group-1">
                    <div class="item-group">
                        <label for="name-${itemCounter}">Name</label>
                        <input type="text" name="item-name[]" id="name-${itemCounter}" required>
                    </div>
                    <div class="item-group">
                        <label for="quantity-${itemCounter}">Quantity</label>
                        <input type="number" name="quantity[]" id="quantity-${itemCounter}" required>
                    </div>
                    <div class="item-group">
                        <label for="price-${itemCounter}">Price</label>
                        <input type="number" name="price[]" id="price-${itemCounter}" required>
                    </div>
                    <div class="item-group">
                        <label for="sku-${itemCounter}">SKU</label>
                        <input type="text" name="sku[]" id="sku-${itemCounter}" value="${sku}" class="sku" required>
                    </div>
                </div>
                <div class="group-1">
                    <div class="item-group">
                        <label for="barcode-${itemCounter}">Barcode</label>
                        <input type="text" name="barcode[]" id="barcode-${itemCounter}" value="${barcode}" class="barcode" >
                    </div>
                    <div class="weight-group">
                        <label for="height-${itemCounter}">Height</label>
                        <input type="number" name="height[]" id="height-${itemCounter}">
                    </div>
                    <div class="weight-group">
                        <label for="width-${itemCounter}">Width</label>
                        <input type="number" name="width[]" id="width-${itemCounter}">
                    </div>
                    <div class="weight-group">
                        <label for="length-${itemCounter}">Length</label>
                        <input type="number" name="length[]" id="length-${itemCounter}">
                    </div>
                    <div class="weight-group">
                        <label for="weight-${itemCounter}">Weight</label>
                        <input type="number" name="weight[]" id="weight-${itemCounter}" class="weight">
                    </div>
                </div>
            </div>
            <button type="button" class="remove-item"><ion-icon name="trash"></ion-icon></button>
        </div>
    `;

    itemBox.appendChild(itemGroup);

    itemGroup.querySelector('.remove-item').addEventListener('click', function() {
        itemBox.removeChild(itemGroup);
    });
});


document.querySelector('.select-box').addEventListener('click', function() {
    const optionsContainer = document.querySelector('.options-container');
    optionsContainer.style.display = optionsContainer.style.display === 'block' ? 'none' : 'block';
});


document.querySelectorAll('.option').forEach(function(option) {
    option.addEventListener('click', function() {
        document.querySelector('.select-box').textContent = option.textContent;
        document.querySelector('#category_id').value = option.dataset.value;
        document.querySelector('.options-container').style.display = 'none';
    });
});









