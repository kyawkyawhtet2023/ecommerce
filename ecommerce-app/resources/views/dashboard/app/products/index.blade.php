@extends('layouts.dashboard-app')

@vite('resources/css/app/dashboard/product/index.css')
@vite('resources/js/dashboard/product/index.js')

@section('content')
<div class="container">
    <div class="product-container"> 
        <div class="header-container">
            <div class="btn-group">
                <a class="filter-btn" href="{{route('products.create')}}">Add New Product</a>
                <a id="all-products" class="filter-btn" href="{{route('products.index')}}">All Products</a>
                <button type="button" id="active" class="filter-btn" onclick="filterProducts('active')">Active Products</button>
                <button type="button" id="inactive" class="filter-btn" onclick="filterProducts('inactive')">Inactive Products</button>
                <button type="button" id="out-of-stock" class="filter-btn" onclick="filterProducts('out_of_stock')">Out Of Stock</button>
            </div>
            <div class="search-container">
                <form id="search-form" method="GET" action="{{ route('products.index') }}">
                    <div>
                        <label for="search_name">Product Name</label>
                        <input type="search" name="search_name" placeholder="Search Products Name..." value="{{ request('search_name') }}">
                        <button type="submit"><ion-icon name="search"></ion-icon></button>
                    </div>
                    <div>
                        <label for="search_barcode">Barcode ID</label>
                        <input type="search" name="search_barcode" placeholder="Search Products Barcode..." value="{{ request('search_barcode') }}">
                        <button type="submit"><ion-icon name="search"></ion-icon></button>
                    </div>
                    <div>
                        <label for="search_sku">SKU ID</label>
                        <input type="search" name="search_sku" placeholder="Search Products SKU..." value="{{ request('search_sku') }}">
                        <button type="submit"><ion-icon name="search"></ion-icon></button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="table-container">
                @if($products->isEmpty())
                    <p>No products found.</p>
                @else
                    <form id="product-selection-form" method="POST" action="{{ route('products.bulkAction') }}">
                        @csrf
                        <div class="table-head-btn">
                            <input type="hidden" id="bulk-action" name="action" value="">
                            <button type="button" id="delete-btn" disabled onclick="setBulkAction('delete')">Delete</button>
                            <button type="button" id="deactivate-btn" disabled onclick="setBulkAction('deactivate')">Deactivate</button>
                        </div>

                        <div  class="table">
                            <div class="thead">
                                
                                <input type="checkbox" id="select-all"></th>
                                <span> Product Details </span>
                                
                               
                            </div>
                            <div class="tbody">
                                @foreach($products as $product)
                                    <div class="product-group-form">
                                        
                                        <div class="check-product"><input type="checkbox" name="product_ids[]" value="{{ $product->id }}"></div>
                                        <div class="product-group">

                                            <div class="head">
                                                <div><img src="{{ Storage::url($product->image_1)}}" width="50" height="50" ></div>
                                                <div>{{ $product->name }}</div>   
                                            </div>

                                            <div class="item-container">
                                                @foreach ($product->productitems as $item)
                                                <div class="item-group"> 
                                                    <div><img src="{{ Storage::url($item->image) }}" width="50" height="50"></div>
                                                    <div>{{ $item->name }}</div>
                                                    <div class="input-container">
                                                        <label for="price">Price</label>
                                                        <div  class="price-container">
                                                            <input type="text" name="price" id="price-{{ $item->id }}" 
                                                                value="{{ number_format($item->price, 0, '.', ',') }}" 
                                                                readonly 
                                                                    />
                                                            <p> Ks, </p>
                                                            <ion-icon name="create" class="price-edit" data-id="{{ $item->id }}"></ion-icon>
                                                            <p class="price-message"> edit </p>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="input-container" >
                                                        <label for="quantity">Stock</label>
                                                        <div class="price-container">
                                                            <input type="number" name="quantity" id="quantity-{{ $item->id }}" value="{{ $item->quantity }}" readonly/>
                                                            <ion-icon name="create" class="quantity-edit" data-id="{{ $item->id }}"></ion-icon>
                                                            <p class="stock-edit"> edit </p>
                                                        </div>
                                                    </div>

                                                    <div class="barcode-container">
                                                        <label for="barcode">Barcode</label>
                                                        <span class="barcode-text"> 
                                                            <p id="barcode-text">{{ $item->barcode ?? 'N/A' }} </p>
                                                            <ion-icon name="copy" id="barcode-copy" onclick="copyToClipboard('barcode-text', 'Barcode copied!')"></ion-icon>
                                                            <p class="barcode-message"> copy </p>
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="barcode-container">
                                                        <label for="sku">SKU</label>
                                                        <span class="sku-text">
                                                             
                                                            <p id="sku-text" > {{ $item->sku ?? 'N/A' }} </p>
                                                            <ion-icon name="copy" id="sku-copy" onclick="copyToClipboard('sku-text', 'SKU copied!')"></ion-icon>
                                                            <p class="SKU-message"> copy </p>

                                                        </span>
                                                    </div>

                                                    <div>
                                                        <div class="{{ $item->is_active ? 'status-btn-active' : 'status-btn-inactive' }}">
                                                            <div class="{{ $item->is_active ? 'active' : 'inactive' }} status-toggle-itembtn"  data-id="{{ $item->id }}"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                        <div class="product-btn-container"> 
                                            <div class="status-container">
                                                <div class="{{ $product->is_active ? 'status-btn-active' : 'status-btn-inactive' }}">
                                                    <div class="{{ $product->is_active ? 'active' : 'inactive' }} status-toggle-btn" data-id="{{ $product->id }}"></div>
                                                </div>
                                            </div>
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn " onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pagination">
                            {{ $products->links() }}
                        </div>
                    </form>
                @endif
           
        </div>
    </div>
</div>


<div id="notification" class="notificaton">
    <!-- Dynamic content will go here -->
</div>

<script>
    const route = "{{ route('products.bulkAction') }}";
    const bulkAction ="{{ route('products.bulkAction') }}";
    function showNotification(message) {
        const notification = document.getElementById("notification");
        notification.innerText = message;
        
        notification.style.display = "block";
        
        setTimeout(() => {
            notification.style.display = "none";
        }, 2000);
    }

    function setBulkAction(action) {
        const selectedProducts = Array.from(document.querySelectorAll('input[name="product_ids[]"]:checked'))
                                     .map(checkbox => checkbox.value);

        if (selectedProducts.length === 0) {
            showNotification("Please select at least one product.", "red");
            return;
        }

        fetch(bulkAction, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ action, product_ids: selectedProducts })
        })
        .then(response => response.json())
        .then(data => {
            showNotification(data.message, data.success ? "white" : "red");
            if (data.success) location.reload();
        })
        .catch(error => {
            showNotification("Network Error!", "red");
            console.error('Error:', error);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
    
    function addInlineEditListeners(type) {
        document.querySelectorAll(`.${type}-edit`).forEach(icon => {
            icon.addEventListener('click', function () {
                const itemId = this.dataset.id;
                const inputElement = document.getElementById(`${type}-${itemId}`);
                inputElement.removeAttribute('readonly');
                inputElement.focus();

                
                formatInputValue(inputElement);

                inputElement.addEventListener('blur', function () {
                    const updatedValue = inputElement.value.replace(/[^0-9]/g, ''); 
                    updateItem(itemId, { [type]: updatedValue });
                    inputElement.setAttribute('readonly', true);
                });
            });
        });
    }

    addInlineEditListeners('price');
    addInlineEditListeners('quantity');

  
    function updateItem(itemId, data) {
        const updateUrl = "{{ route('productItem.update', ':id') }}".replace(':id', itemId);

        fetch(updateUrl, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(() => {
            showNotification(`${Object.keys(data)[0]} updated!`, "white");
        })
        .catch(() => {
            showNotification("Network Error!", "red");
        });
    }

  
    function formatInputValue(inputElement) {
        const currentValue = inputElement.value.replace(/[^0-9]/g, '');
        const formattedValue = new Intl.NumberFormat('en-US', {
            style: 'decimal',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(currentValue);
        
        inputElement.value = formattedValue;
    }



       
        function addToggleListeners(buttonClass, updateFunction) {
            document.querySelectorAll(buttonClass).forEach(toggleButton => {
                toggleButton.addEventListener('click', function () {
                    const itemId = this.dataset.id;
                    const isActive = this.classList.contains('active');

                   
                    this.classList.toggle('active', !isActive);
                    this.classList.toggle('inactive', isActive);
                    this.parentElement.classList.toggle('status-btn-active', !isActive);
                    this.parentElement.classList.toggle('status-btn-inactive', isActive);

                    updateFunction(itemId, !isActive);
                });
            });
        }

        function updateProductStatus(productId, newStatus) {
            fetch(`/products/toggleStatus/${productId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_active: newStatus })
            })
            .then(response => response.json())
            .then(() => {
                showNotification('Product status updated!', "white");
            })
            .catch(() => {
                showNotification('Network Error!', "red");
            });
        }

        function updateProductItemStatus(itemId, newStatus) {
            fetch(`/productItem/toggleStatus/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_active: newStatus })
            })
            .then(response => response.json())
            .then(() => {
                showNotification('Item status updated!', "white");
            })
            .catch(() => {
                showNotification('Network Error!', "red");
            });
        }

        
        addToggleListeners('.status-toggle-btn', updateProductStatus);
        addToggleListeners('.status-toggle-itembtn', updateProductItemStatus);

    });

        function copyToClipboard(elementId, message) {
        const textToCopy = document.getElementById(elementId).innerText;

        if (navigator.clipboard) {
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    showNotification(message, "white");
                })
                .catch(err => {
                    console.error('Error copying text to clipboard:', err);
                    showNotification("Failed to copy text!", "red");
                });
        } else {
            
            const tempInput = document.createElement("input");
            tempInput.style.position = "absolute";
            tempInput.style.left = "-9999px";
            tempInput.value = textToCopy;
            document.body.appendChild(tempInput);

            tempInput.select();
            tempInput.setSelectionRange(0, 99999); 
            document.execCommand("copy");

            document.body.removeChild(tempInput);
            showNotification(message, "white");
        }
    }

    function showNotification(message, color) {
        const notification = document.getElementById("notification");
        notification.innerText = message;
        notification.style.color = color;
        notification.style.display = "block";

        setTimeout(() => {
            notification.style.display = "none";
        }, 2000);
    }
</script>



@endsection
