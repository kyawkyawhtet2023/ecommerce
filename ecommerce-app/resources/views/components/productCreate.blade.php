<div class="create-container">
    <form id="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="image-container">
            @for ($i = 1; $i <= 6; $i++)
                <label for="image_{{ $i }}">
                    <input type="file" class="form-control" id="image_{{ $i }}" name="image_{{ $i }}" accept="image/*" onchange="previewImage(event, 'image-{{ $i }}')" {{ $i === 1 ? 'required' : '' }}>
                    <img src="{{ Storage::url($profiles->background_image) ?? asset('images/default-placeholder.png') }}" id="image-{{ $i }}">
                    {{ $i === 1 ? 'Main Image' : 'Image' }}
                </label>
            @endfor
        </div>
       
        <div class="row">
            <div class="name-group">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required maxlength="255">

                </div>
        
                <div class="category-container">
                    <label for="category_id" class="form-label">Category</label>
                    <div class="custom-select" id="custom-category-select">
                        <div class="select-box">Select Category</div>
                        <div class="options-container">
                            @foreach($categories as $category)
                                <div class="option" data-value="{{ $category->id }}">{{ $category->name }}</div>
                            @endforeach
                        </div>
                        <input type="hidden" name="category_id" id="category_id" required>
                    </div>
                    <div class="category-btn"> 
                        <a id="new-category" href="{{route('categories.index')}}">Add New Category</a>
                        
                        
                    </div>
                    
                </div>
            </div>
    
            <div class="highlight-container">
                <label for="highlight" class="form-label">Highlight</label>
                <div class="box-container">
                    <div class="toolbar">
                        <button type="button" class="format-btn" onclick="format('bold', this)">Bold</button>
                        <button type="button" class="format-btn" onclick="format('italic', this)">Italic</button>
                        <button type="button" class="format-btn" onclick="format('underline', this)">Underline</button>
                        <button type="button" class="format-btn" onclick="format('insertOrderedList', this)">Ordered List</button>
                        <button type="button" class="format-btn" onclick="format('insertUnorderedList', this)">Unordered List</button>
                        <button type="button" class="format-btn" onclick="format('createLink', this, prompt('Enter the URL'))">Link</button>
                    </div>
                    <div id="highlight" class="editor" contenteditable="true" required></div>
                    <input type="hidden" name="highlight" id="highlight-input">
                </div>
            </div>
            
            <div class="highlight-container">
                <label for="description" class="form-label">Description</label>
                <div class="box-container">
                    <div class="toolbar">
                        <button type="button" class="format-btn" onclick="format('bold', this)">Bold</button>
                        <button type="button" class="format-btn" onclick="format('italic', this)">Italic</button>
                        <button type="button" class="format-btn" onclick="format('underline', this)">Underline</button>
                        <button type="button" class="format-btn" onclick="format('insertOrderedList', this)">Ordered List</button>
                        <button type="button" class="format-btn" onclick="format('insertUnorderedList', this)">Unordered List</button>
                        <button type="button" class="format-btn" onclick="format('createLink', this, prompt('Enter the URL'))">Link</button>
                    </div>
                    
                    <div id="description" class="editor" contenteditable="true" required></div>
                    <input type="hidden" name="description" id="description-input">
                </div>
            </div>
        </div>

        <div class="item-container">
            <button class="item-btn" type="button" id="add-item">New Item</button>
            <div class="item-box" id="item-box">

            </div>
        </div>

        <div class="btn-container">
            <button type="button" class="cancel" id="create-cancel">Cancel</button>
            <button type="submit" class="btn-create" id="product-btn">Create Product</button>
        </div>
    </form>
</div>

<script>
    

    let itemCounter = 1;

document.getElementById('add-item').addEventListener('click', function() {
    const itemBox = document.getElementById('item-box');
    const itemGroup = document.createElement('div');
    const sku = 'SKU-' + Date.now();
    const barcode = Date.now().toString().slice(-6) + Math.floor(Math.random() * 900000 + 100000);
    itemGroup.className = 'item-group';

    i++; 

    itemGroup.innerHTML = `
         <div class="new-item">
            <div class="img-group">
                <label for="item-image-${itemCounter}">
                <input type="file" accept="image/*" name="image[]" id="item-image-${itemCounter}" onchange="previewImage(event, 'item-${itemCounter}')" >
                <img class="item-img" src="${defaultImagePath}" id="item-${itemCounter}"  >Image
                </label>
            </div>
            <div class="detail-group">
                <div class="group-1">
                    <div class="item-group">
                        <label for="name-${itemCounter}">Name</label>
                        <input type="text" name="item-name[]" id="name-${itemCounter}">
                    </div>
            
                    <div class="item-group">
                        <label for="quantity-${itemCounter}">Quantity</label>
                        <input type="number" name="quantity[]" id="quantity-${itemCounter}">
                    </div>
            
                    <div class="item-group">
                        <label for="price-${itemCounter}">Price</label>
                        <input type="number" name="price[]" id="price-${itemCounter}">
                    </div>
            
                    <div class="item-group">
                        <label for="sku-${itemCounter}">SKU</label>
                        <input type="text" name="sku[]" id="sku-${itemCounter}" value="${sku}" class="sku">
                    </div>
                </div>
            
                <div class="group-1">
                    <div class="item-group">
                        <label for="barcode-${itemCounter}">Barcode</label>
                        <input type="text" name="barcode[]" id="barcode-${itemCounter}" value="${barcode}" class="barcode"> 
                        
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
                        <input type="number" name="weight[]" id="weight-${itemCounter}" class="weight>
                    </div>
                </div>
            </div>

            <div class="group-3">
                <button type="button" class="remove-item"><ion-icon name="trash"></ion-icon></button>
            </div>
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
       
        document.querySelector('.select-box').textContent = this.textContent;
        document.querySelector('#category_id').value = this.getAttribute('data-value');

        
        document.querySelector('.options-container').style.display = 'none';
    });
});









    </script>


