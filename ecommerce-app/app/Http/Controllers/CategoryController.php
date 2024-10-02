<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
       
        $imagePath = $this->storeImage($request);

       
        Category::create(array_merge($request->validated(), $imagePath));

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        // Delete old image if a new one is uploaded
        $this->deleteOldImage($request, $category);

        // Store the new image and get the path
        $imagePath = $this->storeImage($request);

        // Update the category with validated data and the new image path
        $category->update(array_merge($request->validated(), $imagePath));

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully!',
                'category' => $category, // Optionally return the updated category
            ]);
        }

        // Fallback for non-AJAX request (if needed)
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }


    private function storeImage(Request $request)
    {
        $imagePath = [];

        if ($request->hasFile('image')) {
            $imagePath['image'] = $request->file('image')->store('categoryImages', 'public');
        }

        return $imagePath;
    }

    private function deleteOldImage(Request $request, Category $category)
    {
        if ($request->hasFile('image')) {
            // Delete old image from storage
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
        }
    }

    public function destroy(Category $category)
    {
        // Delete the associated image from storage
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
