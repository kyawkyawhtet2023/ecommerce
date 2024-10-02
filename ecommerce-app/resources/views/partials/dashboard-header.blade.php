@vite('resources/css/app/dashboard/dashboard-header.css')

    <div class="logo-container">
        <!-- Check if $profiles is not null to avoid errors -->
        @if($profiles)
            <img class="logo-img" src="{{ Storage::url($profiles->day_image) }}" alt="Profile Image">
            <h1>{{ $profiles->name }}</h1>
        @else
            <p>No profile available.</p>
        @endif
    </div>
    <div class="group-2">
        <div class="noti-container">
            <ion-icon name="notifications"></ion-icon>
            <spam> 0 </spam>
        </div>
    </div>

    <div class="user-menu-container" id="user-profile">
        <img class="user-image" id="user-image" src="{{ Auth::user() ? Storage::url(Auth::user()->image) : asset('images/default-user.png') }}" alt="User Image">
        <ion-icon name="settings" class="setting-icon" id="setting-icon"></ion-icon>
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
    

<script>
    const userProfile = document.getElementById('user-profile');
    const userList = document.getElementById('user-list');
    const userImage = document.getElementById('user-image');
    const userIcon = document.getElementById('setting-icon');
    
    userProfile.addEventListener('click', () => {
        if (userList.classList.contains('show')) {
            userList.classList.remove('show');
            userList.classList.add('hide');
            userImage.style.borderColor = "";
            userIcon.style.color = ""; 
            userIcon.style.borderColor = ""; 
            userIcon.classList.remove('rotate'); 
            userIcon.classList.add('unrotate');
        } else {
            userList.classList.remove('hide');
            userList.classList.add('show'); 
            userImage.style.borderColor = "#00ff40d7"; 
            userIcon.style.color = "#00ff40d7"; 
            userIcon.style.borderColor = "#00ff40d7"; 
            userIcon.classList.remove('unrotate');
            userIcon.classList.add('rotate'); 
        }
    });
</script>


