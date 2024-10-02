@extends('layouts.dashboard-app')
@vite ('resources/css/app/dashboard/profile/index.css','resources/js/dashboard/profile/index.js')

@section('content')
<div class="container" id="showContainer">
    

    <div class="group-form">
        <div class="image-group">
            <img src="{{ Storage::url($profile->day_image) }}" alt="Day Image">
            <label for="day_image">Day Mode</label>
        </div>

        <div class="image-group">
            <img src="{{ Storage::url($profile->night_image) }}" alt="Night Image">
            <label for="night_image">Night Mode</label>
        </div>

        <div class="image-group">
            <img src="{{ Storage::url($profile->background_image) }}" alt="Background Image">
            <label for="background">Background</label>
        </div>
    </div>

    <div class="group-form">
        
        <div class="color-group">
            <label>Primary  </label>
            <div class="color-box" style="background-color:var(--primary);"></div>
            <span>{{ $profile->primary }}</span>
        </div>

        <div class="color-group">
            <label>Secondary </label>
            <div class="color-box" style="background-color:var(--secondary);"></div>
            <span>{{ $profile->secondary }}</span>
        </div>

        <div class="color-group">
            <label>Name  </label>
            <div class="color-box" style="background-color:var(--name);"></div>
            <span >{{ $profile->name_color }}</span>
        </div>

        <div class="color-group">
            <label>Title  </label>
            <div class="color-box" style="background-color:var(--title);"></div>
            <span>{{ $profile->title_color }}</span>
        </div>

        <div class="color-group">
            <label>Body </label>
            <div class="color-box" style="background-color:var(--body);"></div>
            <span>{{ $profile->body_color }}</span>
        </div>

        <div class="color-group">
            <label>Price Color: </label>
            <div class="color-box" style="background-color:var(--price);"></div>
            <span>{{ $profile->price_color }}</span>
        </div>
    </div>

    <div class="profile">
        <div class="form">
            <h1>{{ $profile->name }}</h1>
        </div>

        <div class="form">
            <div>
                <label >Email : </label>
                <spam> {{$profiles->email}} </spam>
            </div>

            <div>
                <label >Phone :</label>
                <spam> {{$profiles->phone}} </spam>
            </div>

            
        </div>

        <div class="form">
            <label >Address : </label>
            <spam> {{$profiles->address}} </spam>
        </div>

        <div class="form">
            <button id="edit" > Edit </button>
           

        </div>
    </div>
</div>



<div class="update-container">
    <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

       
    

        <div class="group-form">
            <div class="image-group">
                <label for="day_image">
                    <input type="file" id="day_image" name="day_image" accept="image/*" onchange="previewImage(event, 'day_image_preview')">
                    <img id="day_image_preview" src="{{ Storage::url($profile->day_image) }}" alt="Day Image">
                    Day Logo
                </label>
            </div>
        
            <div class="image-group">
                <label for="night_image">
                    <input type="file" id="night_image" name="night_image" accept="image/*" onchange="previewImage(event, 'night_image_preview')">
                    <img id="night_image_preview" src="{{ Storage::url($profile->night_image) }}" alt="Night Image">
                    Night Logo
                </label>
            </div>
        
            <div class="image-group">
                <label for="background_image">
                    <input type="file" id="background_image" name="background_image" accept="image/*" onchange="previewImage(event, 'background_image_preview')">
                    <img id="background_image_preview" src="{{ Storage::url($profile->background_image) }}" alt="Background Image">
                    Background Image
                </label>
            </div>
        </div>

        <div class="group-form">
            <div class="form-group">
                <label for="primary">Primary Color:</label>
                <input type="color" id="primary" name="primary" value="{{ old('primary', $profile->primary) }}">
            </div>

            <div class="form-group">
                <label for="secondary">Secondary Color:</label>
                <input type="color" id="secondary" name="secondary" value="{{ old('secondary', $profile->secondary) }}">
            </div>

            <div class="form-group">
                <label for="name_color">Name Color:</label>
                <input type="color" id="name_color" name="name_color" value="{{ old('name_color', $profile->name_color) }}">
            </div>

            <div class="form-group">
                <label for="title_color">Title Color:</label>
                <input type="color" id="title_color" name="title_color" value="{{ old('title_color', $profile->title_color) }}">
            </div>

            <div class="form-group">
                <label for="body_color">Body Color:</label>
                <input type="color" id="body_color" name="body_color" value="{{ old('body_color', $profile->body_color) }}">
            </div>

            <div class="form-group">
                <label for="price_color">Price Color:</label>
                <input type="color" id="price_color" name="price_color" value="{{ old('price_color', $profile->price_color) }}">
            </div>
        </div>
        <div class="update-group-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $profile->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}" required>
            </div>
        
           
        </div>

        <div class="group-form">
            <div class="form-group address">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required>{{ old('address', $profile->address) }}</textarea>
            </div>
        </div>

        <div class="btn-group">
            <button type="button" id="cancel" >Cancel </button>
            <button type="submit" class="btn">Update Profile</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event, imageId) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById(imageId);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('edit');
    const showContainer = document.getElementById('showContainer');
    const updateContainer = document.querySelector('.update-container');
    const cancelButton =document.getElementById('cancel');

    editButton.addEventListener('click', function () {
        showContainer.style.display = "none";
        updateContainer.style.display = "block";
        

    });

    cancelButton.addEventListener('click',function (){

        updateContainer.style.display = "none";
        showContainer.style.display ="block";
    });
});

</script>

@endsection
