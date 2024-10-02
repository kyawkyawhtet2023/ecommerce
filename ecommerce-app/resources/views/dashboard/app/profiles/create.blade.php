

{{-- @extends('layouts.app')

@section('content') --}}
<div class="container">
    <h2>Create New Profile</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('app_profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Profile Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="day_image">Day Image</label>
            <input type="file" id="day_image" name="day_image" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="night_image">Night Image</label>
            <input type="file" id="night_image" name="night_image" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="background_image">Background Image</label>
            <input type="file" id="background_image" name="background_image" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="primary">Primary Color</label>
            <input type="color" id="primary" name="primary" class="form-control" value="#ffffff" required>
        </div>

        <div class="form-group">
            <label for="secondary">Secondary Color</label>
            <input type="color" id="secondary" name="secondary" class="form-control" value="#000000" required>
        </div>

        <div class="form-group">
            <label for="name_color">Name Color</label>
            <input type="color" id="name_color" name="name_color" class="form-control" value="#000000" required>
        </div>

        <div class="form-group">
            <label for="title_color">Title Color</label>
            <input type="color" id="title_color" name="title_color" class="form-control" value="#000000" required>
        </div>

        <div class="form-group">
            <label for="price_color">Price Color</label>
            <input type="color" id="price_color" name="price_color" class="form-control" value="#000000" required>
        </div>

        <div class="form-group">
            <label for="body_color">Body Color</label>
            <input type="color" id="body_color" name="body_color" class="form-control" value="#ffffff" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Profile</button>
    </form>
</div>
{{-- @endsection --}}
