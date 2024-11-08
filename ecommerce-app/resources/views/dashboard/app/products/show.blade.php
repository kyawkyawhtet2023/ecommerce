@extends('layouts.dashboard-app')
@vite('resources/css/app/dashboard/product/show.css')
@vite('resources/js/dashboard/product/show.js')
@section('content')
<div class="container">
    <ion-icon name="arrow-back-circle-outline" class="back-icon"  onclick="goBack('back')"></ion-icon>
    <div class="product-container">
        

        <div class="image-container">
            <div class="main-img-container">
                <img src="{{ asset('storage/' . $product->{"image_1"}) }}" id="main-img" />
            </div>
            <div class="row-image-container">
                @for ($i = 1; $i <= 6; $i++)
                    @if ($product->{"image_$i"})
                        <div class="row-image">
                            <img src="{{ asset('storage/' . $product->{"image_$i"}) }}" alt="Product Image {{ $i }}" onclick="changeMainImage('{{ asset('storage/' . $product->{"image_$i"}) }}')" />
                        </div>
                    @endif
                @endfor
            </div>
        </div>

        <div class="header-container">
            <h2>{{ $product->name }}</h2>
            <p><strong>Category:</strong> {{ $product->category->name }}</p>
            <div class="item-container">
                @foreach ($product->productItems as $item)
                <div class="item "  onclick="changeMainImage('{{ asset('storage/' . $item->image) }}')">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{$item->name}}"  >
                    <p> {{$item->name}}</p>
                    <span>{{ number_format($item->price, 0) }} Ks.</span>
                    <p class="{{ $item->is_active ? 'active' : 'inactive' }}"> {{ $item->is_active ? 'Active' : 'Inactive' }}</p>
                    <span> Stock  [ {{$item->quantity}} ] </span>
                </div>
                
                @endforeach
            </div> 

            <div class="highlight-conainer">
                <h3>Highlight</h3>
                <p>{!! ($product->highlight)!!}</p>
            </div>

            <div class="action-container">
                <a href="{{ route('products.edit', $product->id) }}" class="edit">Edit Product <ion-icon name="create"></ion-icon> </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST"   >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete Product <ion-icon name="trash"></ion-icon></button>
                </form>
                
            </div>
        </div>


        <div class="description-conatiner">
            <h3>Description</h3>
            <p>{!! ($product->description) !!}</p>   
        </div>
        

       

    </div>
</div>


<script>
    

</script>
@endsection
