@vite('resources/css/app/user/header.css')

<header>
    
    <div class="logo-container">
        
        <img class="logo" src="{{ $profiles ? Storage::url($profiles->day_image) : asset('images/default-logo.png') }}" alt="Profile Image">
        
        <h1>{{ $profiles->name ?? 'Default Title' }}</h1>
    </div>

    
    <div class="search-container">
        <form method="GET" action="/search" class="search-form">
            @csrf
            
            <input type="search" id="search-input" name="query" placeholder="Search..." aria-label="search" value="{{ request()->input('query') }}">
           
            <button type="submit" id="search-btn">
                <ion-icon name="search"></ion-icon>
            </button>
        </form>
    </div>

    
    <div class="list-container">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><ion-icon name="home"></ion-icon> Home</a>
        <a href="/cart" class="{{ request()->is('cart') ? 'active' : '' }}"><ion-icon name="cart"></ion-icon> Cart</a>
        <a href="/order" class="{{ request()->is('order') ? 'active' : '' }}"><ion-icon name="logo-dropbox"></ion-icon> Order</a>
    </div>

   
    <div class="user-menu-container" id="user-profile">
    
        <img class="user-image" id="user-image" src="{{ Auth::user() ? Storage::url(Auth::user()->image) : asset('images/default-user.png') }}" alt="User Image">
        <ion-icon id="user-icon" name="menu" class="menu-icon"></ion-icon>
    </div>
    <div class="user-list" id= "user-list">
        <div class="user-profile">
            <img class="user-image"  src="{{ Auth::user() ? Storage::url(Auth::user()->image) : asset('images/default-user.png') }}" alt="User Image">
            <h4> {{Auth::user()->name ?? "name"}} </h4>
        </div>
        <div class="">
            <ul>
                <li><a href="">Edit Profile</a></li>
                <li><a href="/">Order List</a></li>
                <li><a href="/">Cart</a></li>
                <li><a href="">Help</a></li>
                <li><a href="">Policies</a></li>
            </ul>
        </div>
    
       
    </div>
</header>
<script>
const userProfile = document.getElementById('user-profile');
const userList = document.getElementById('user-list');
const userImage = document.getElementById('user-image');
const userIcon = document.getElementById('user-icon');

userProfile.addEventListener('click', () => {
    if (userList.classList.contains('show')) {
        
        userList.classList.remove('show');
        userList.classList.add('hide');
        userImage.style.borderColor = "";
        userIcon.style.color = ""; 
        userIcon.style.borderColor = ""; 
    } else {
        
        userList.classList.remove('hide');
        userList.classList.add('show'); 
        userImage.style.borderColor = "#00ff40d7"; 
        userIcon.style.color = "#00ff40d7"; 
        userIcon.style.borderColor = "#00ff40d7"; 
    }
});

</script>