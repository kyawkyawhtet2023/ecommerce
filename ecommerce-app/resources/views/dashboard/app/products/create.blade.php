@extends('layouts.dashboard-app')
@vite('resources/css/app/dashboard/product/create.css')

@vite ('resources/js/dashboard/product/create.js')


@section('content')
<div class="container">
    <div class="create-container">
        <form id="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="image-container">
                @for ($i = 1; $i <= 6; $i++)
                    <label for="image_{{ $i }}">
                        <input type="file" class="form-control" id="image_{{ $i }}" name="image_{{ $i }}" accept="image/*" onchange="previewImage(event, 'image-{{ $i }}')" {{ $i === 1 ? 'required' : '' }}>
                        <img src="{{ isset($profiles) && $profiles->background_image ? Storage::url($profiles->background_image) : asset('images/default-placeholder.png') }}" id="image-{{ $i }}">
                        {{ $i === 1 ? 'Main Image' : 'Image' }}
                    </label>
                @endfor
            </div>

            <div class="row">
                <div class="name-group">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" required>
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
                    <div class="new-item">
                        <div class="img-group">
                            <label for="item-image-0">
                                <input type="file" accept="image/*" name="image[]" id="item-image-0" onchange="previewImage(event, 'item-0')" required>
                                <img class="item-img" src="{{ isset($profiles) && $profiles->background_image ? Storage::url($profiles->background_image) : asset('images/default-placeholder.png') }}" id="item-0"> Image
                            </label>
                        </div>
                        <div class="detail-group">
                            <div class="group-1">
                                <div class="item-group">
                                    <label for="name-0">Name</label>
                                    <input type="text" name="item-name[]" id="name-0" oninput="generateSkuAndBarcode()" required>
                                </div>
                                <div class="item-group">
                                    <label for="quantity-0">Quantity</label>
                                    <input type="number" name="quantity[]" id="quantity-0" required>
                                </div>
                                <div class="item-group">
                                    <label for="price-0">Price</label>
                                    <input type="number" name="price[]" id="price-0" required>
                                </div>
                                <div class="item-group">
                                    <label for="sku-${itemCounter}">SKU</label>
                                    <input type="text" name="sku[]" id="sku-0" value="" class="sku" required>
                                </div>
                            </div>
                            <div class="group-1">
                                <div class="item-group">
                                    <label for="barcode-0">Barcode</label>
                                    <input type="text" name="barcode[]" id="barcode-0" value="" class="barcode" >
                                </div>
                                <div class="weight-group">
                                    <label for="height-0">Height</label>
                                    <input type="number" name="height[]" id="height-0">
                                </div>
                                <div class="weight-group">
                                    <label for="width-0">Width</label>
                                    <input type="number" name="width[]" id="width-0">
                                </div>
                                <div class="weight-group">
                                    <label for="length-0">Length</label>
                                    <input type="number" name="length[]" id="length-0">
                                </div>
                                <div class="weight-group">
                                    <label for="weight-0">Weight</label>
                                    <input type="number" name="weight[]" id="weight-0" class="weight">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="remove-item"><ion-icon name="trash"></ion-icon></button>
                    </div>
                </div>
            </div>

            <div class="btn-container">
                <button type="button" class="cancel" id="create-cancel">Cancel</button>
                <button type="submit" class="btn-create" id="product-btn">Public</button>
            </div>
        </form>
    </div>
</div>

<script>
    
    function generateSkuAndBarcode() {
    const nameField = document.getElementById("name-0").value;
    const skuField = document.getElementById("sku-0");
    const barcodeField = document.getElementById("barcode-0");

    if (nameField) {
        const sku = 'SKU-' + Date.now();
        const barcode = Date.now().toString().slice(-6) + Math.floor(Math.random() * 900000 + 100000);

        skuField.value = sku;
        barcodeField.value = barcode;
    } else {
        skuField.value = '';
        barcodeField.value = '';
    }
}


    function format(command, button, value = null) {
        document.execCommand(command, false, value);
        button.classList.toggle('active', document.queryCommandState(command));
    }
    document.querySelector('form').onsubmit = function () {
        document.querySelector('#highlight-input').value = document.querySelector('#highlight').innerHTML;
        document.querySelector('#description-input').value = document.querySelector('#description').innerHTML;
    };

    const defaultImagePath = "{{ isset($profiles) && $profiles->background_image ? Storage::url($profiles->background_image) : asset('images/default-placeholder.png') }}";

    
    
</script>


@endsection