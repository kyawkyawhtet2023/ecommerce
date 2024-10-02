<!-- resources/views/components/edit-profile.blade.php -->

<form action="{{ route('profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="group-form">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $profile->name }}" required>
    </div>

    <div class="group-form">
        <div class="image-group">
            <label for="day_image">Day Image</label>
            <input type="file" name="day_image" id="day_image">
            <img src="{{ Storage::url($profile->day_image) }}" alt="Day Image">
        </div>

        <div class="image-group">
            <label for="night_image">Night Image</label>
            <input type="file" name="night_image" id="night_image">
            <img src="{{ Storage::url($profile->night_image) }}" alt="Night Image">
        </div>

        <div class="image-group">
            <label for="background_image">Background Image</label>
            <input type="file" name="background_image" id="background_image">
            <img src="{{ Storage::url($profile->background_image) }}" alt="Background Image">
        </div>
    </div>

    <div class="group-form">
        <label for="primary">Primary Color</label>
        <input type="color" name="primary" id="primary" value="{{ $profile->primary }}">

        <label for="secondary">Secondary Color</label>
        <input type="color" name="secondary" id="secondary" value="{{ $profile->secondary }}">

        <label for="name_color">Name Color</label>
        <input type="color" name="name_color" id="name_color" value="{{ $profile->name_color }}">

        <label for="title_color">Title Color</label>
        <input type="color" name="title_color" id="title_color" value="{{ $profile->title_color }}">

        <label for="body_color">Body Color</label>
        <input type="color" name="body_color" id="body_color" value="{{ $profile->body_color }}">

        <label for="price_color">Price Color</label>
        <input type="color" name="price_color" id="price_color" value="{{ $profile->price_color }}">
    </div>

    <button type="submit">Update Profile</button>
</form>
