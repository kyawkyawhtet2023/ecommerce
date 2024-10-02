<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppProfile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAppProfileRequest; // Make sure to import your custom request

class AppProfileController extends Controller
{

    public function index(){
        $profile = AppProfile::all()->last();
        return view('dashboard.app.profiles.index', compact('profile'));
    }
    public function update(StoreAppProfileRequest $request, AppProfile $profile)
    {
        // Delete old images if new ones are uploaded
        $this->deleteOldImages($request, $profile);
    
        // Store the new images
        $imagePaths = $this->storeImages($request);
    
        // Update the profile with new data and image paths
        $profile->update(array_merge($request->validated(), $imagePaths));
    
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
    
    private function deleteOldImages(Request $request, AppProfile $profile)
    {
        $images = ['day_image', 'night_image', 'background_image'];
    
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                // Delete old image from storage
                if ($profile->$image) {
                    Storage::disk('public')->delete($profile->$image);
                }
            }
        }
    }
    


    public function create()
    {
        return view('dashboard.app.profiles.create');
    }
    
    public function store(StoreAppProfileRequest $request)
    {
        
        $imagePaths = $this->storeImages($request);

        
        AppProfile::create(array_merge($request->validated(), $imagePaths));

        return redirect()->back()->with('success', 'Profile created successfully!');
    }

    private function storeImages(Request $request)
    {
        $images = ['day_image', 'night_image', 'background_image'];
        $imagePaths = [];

        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                $imagePaths[$image] = $request->file($image)->store('Appimages', 'public');
            }
        }

        return $imagePaths;
    }
}
