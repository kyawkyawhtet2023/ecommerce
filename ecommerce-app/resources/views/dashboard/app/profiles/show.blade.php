<!-- resources/views/components/show-profile.blade.php -->

<div class="group-form">
    <h1>{{ $profile->name }}</h1>
</div>

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
        <label>Primary Color: </label>
        <div class="color-box" style="background-color:var(--primary);"></div>
        <span>{{ $profile->primary }}</span>
    </div>

    <div class="color-group">
        <label>Secondary Color: </label>
        <div class="color-box" style="background-color:var(--secondary);"></div>
        <span>{{ $profile->secondary }}</span>
    </div>

    <div class="color-group">
        <label>Name Color: </label>
        <div class="color-box" style="background-color:var(--name);"></div>
        <span style="color:var(--name)">{{ $profile->name }}</span>
    </div>

    <div class="color-group">
        <label>Title Color: </label>
        <div class="color-box" style="background-color:var(--title);"></div>
        <span>{{ $profile->title_color }}</span>
    </div>

    <div class="color-group">
        <label>Body Color: </label>
        <div class="color-box" style="background-color:var(--body);"></div>
        <span>{{ $profile->body_color }}</span>
    </div>

    <div class="color-group">
        <label>Price Color: </label>
        <div class="color-box" style="background-color:var(--price);"></div>
        <span>{{ $profile->price_color }}</span>
    </div>
</div>
