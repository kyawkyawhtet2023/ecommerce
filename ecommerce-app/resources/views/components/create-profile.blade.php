<!-- resources/views/components/create-profile.blade.php -->

<form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="group-form">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div class="group-form">
        <div class="image-group">
            <label for="day_image">Day Image</label>
            <input type="file" name="day_image" id="day_image" required>
        </div>

        <div class="image-group">
            <label for="night_image">Night Image</label>
            <input type="file" name="night_image" id="night_image" required>
        </div>

        <div class="image-group">
            <label for="background_image">Background Image</label>
            <input type="file" name="background_image" id="background_image" required>
        </div>
    </div>

    <div class="group-form">
        <label for="primary">Primary Color</label>
        <input type="color" name="primary" id="primary" required>
        
        <label for="secondary">Secondary Color</label>
        <input type="color" name="secondary" id="secondary" required>

        <label for="name_color">Name Color</label>
        <input type="color" name="name_color" id="name_color" required>

        <label for="title_color">Title Color</label>
        <input type="color" name="title_color" id="title_color" required>

        <label for="body_color">Body Color</label>
        <input type="color" name="body_color" id="body_color" required>

        <label for="price_color">Price Color</label>
        <input type="color" name="price_color" id="price_color" required>
    </div>

    <button type="submit">Create Profile</button>
</form>
