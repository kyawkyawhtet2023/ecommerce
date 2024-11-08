@extends('layouts.dashboard-app')
@vite('resources/css/app/dashboard/product/create.css')
@vite('resources/js/dashboard/product/create.js')

@section('content')
<div class="container">
    <div class="create-container">
        <form id="product-form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <div class="image-container">
                @for ($i = 1; $i <= 6; $i++)
                    <label for="image_{{ $i }}">
                        <input type="file" class="form-control" id="image_{{ $i }}" name="image_{{ $i }}" accept="image/*" onchange="previewImage(event, 'image-{{ $i }}')">
                        <img src="{{ $product->{"image_$i"} ? asset('storage/' . $product->{"image_$i"}) : asset('images/default-placeholder.png') }}" id="image-{{ $i }}">
                        {{ $i === 1 ? 'Main Image' : 'Image' }}
                    </label>
                @endfor
            </div>

            <div class="row">
                <div class="name-group">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="category-container">
                        <label for="category_id" class="form-label">Category</label>
                        <div class="custom-select" id="custom-category-select">
                            <div class="select-box">{{ $product->category->name ?? 'Select Category' }}</div>
                            <div class="options-container">
                                @foreach($categories as $category)
                                    <div class="option" data-value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="category_id" id="category_id" value="{{ $product->category_id }}" required>
                        </div>
                        <div class="category-btn">
                            <a id="new-category" href="{{route('categories.index')}}">Add New Category</a>
                        </div>
                    </div>
                </div>

                <div class="highlight-container">
                    <label for="highlight" class="form-label">Highlight</label>
                    <div class="box-container">
                        <div id="highlight" class="editor" contenteditable="true">{!! old('highlight', $product->highlight) !!}</div>
                        <input type="hidden" name="highlight" id="highlight-input">
                    </div>
                </div>

                <div class="highlight-container">
                    <label for="description" class="form-label">Description</label>
                    <div class="box-container">
                        <div id="description" class="editor" contenteditable="true">{!! old('description', $product->description) !!}</div>
                        <input type="hidden" name="description" id="description-input">
                    </div>
                </div>
            </div>
             
            <!-- Existing items -->
            <div class="item-container">
                <button class="item-btn" type="button" id="add-item">New Item</button>

                @foreach($product->productitems as $index => $item)
                <div class="new-item" data-index="{{ $index }}">
                    <input type="hidden" value="{{$item->id}}" name="id">
                    <div class="img-group">
                        <label for="item-image-{{ $index }}">
                            <input type="file" accept="image/*" name="item-image[]" id="item-image-{{ $index }}" onchange="previewImage(event, 'item-{{ $index }}')" value="{{ asset('storage/' . $item->image) }}">
                        <img class="item-img" src="{{ asset('storage/' . $item->image) }}" id="item-{{ $index }}"> Image
                    </label>
                    </div>
                    <div class="detail-group">
                        <div class="group-1">
                            <div class="item-group">
                                <label for="name-0">Name</label>
                                <input type="text" name="item-name[]" value="{{ $item->name }}" required>
                            </div>
                            <div class="item-group">
                                <label for="quantity-0">Quantity</label>
                                <input type="number" name="quantity[]" value="{{ $item->quantity }}" required>
                            </div>
                            <div class="item-group">
                                <label for="price-0">Price</label>
                                <input type="number" name="price[]" value="{{ $item->price }}" required>
                            </div>
                            <div class="item-group">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku[]" value="{{ $item->sku }}" class="sku" required>
                            </div>
                        </div>
                        <div class="group-1">
                            <div class="item-group">
                                <label for="barcode">Barcode</label>
                                <input type="text" name="barcode[]" value="{{ $item->barcode }}" class="barcode">
                            </div>
                            <div class="weight-group">
                                <label for="height">Height</label>
                                <input type="number" name="height[]" id="height" value="{{$item->height}}">
                            </div>
                            <div class="weight-group">
                                <label for="width">Width</label>
                                <input type="number" name="width[]" id="width" value="{{$item->width}}">
                            </div>
                            <div class="weight-group">
                                <label for="length">Length</label>
                                <input type="number" name="length[]" id="length" value="{{$item->length}}">
                            </div>
                            <div class="weight-group">
                                <label for="weight-0">Weight</label>
                                <input type="number" name="weight[]" id="weight" class="weight" value="{{$item->weight}}">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="remove-item"><ion-icon name="trash"></ion-icon></button>
                </div>

                    
                @endforeach

                <div class="item-box" id="item-box">
                </div>
            </div>

            <div class="btn-container">
                <button type="button" class="cancel" id="create-cancel">Cancel</button>
                <button type="submit" class="btn-create" id="product-btn">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function generateSkuAndBarcode() {
        // Custom logic for SKU and Barcode
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
