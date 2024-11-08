@vite(['resources/css/app/dashboard/sidebar.css', 'resources/js/app/dashboard/sidebar.js']) 

<div class="sidebar-container">
    <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
        <ion-icon name="storefront"></ion-icon> Business Profile
    </a>
    <a href="/cart" class="{{ request()->is('cart') ? 'active' : '' }}">
        <ion-icon name="people-circle"></ion-icon> Account Control
    </a>
    <a href="{{route('products.index')}}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
        <ion-icon name="cube"></ion-icon> Products Manage
    </a>

    <a href="{{route('categories.index')}}" class="{{request()->routeIs('categories.index') ? 'active' : ''}}">
        <ion-icon name="layers"></ion-icon> Category 
    </a>

    <a href="/order" class="{{ request()->is('order') ? 'active' : '' }}">
        <ion-icon name="download"></ion-icon> Order
    </a>
</div>

