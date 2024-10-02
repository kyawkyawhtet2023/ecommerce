@extends('layouts.dashboard-app')

@section('content')
@vite('resources/css/app/dashboard/category/index.css')
@vite('resources/js/dashboard/category/index.js')
<div class="container">
    <div class="container-show">
        
            <h1>Categories</h1>

            <!-- Display success messages -->
           

            
            <button type="button" class="create-btn" id="create">Add New Category</button>

            <!-- Categories table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            
                            <td><img src="{{ Storage::url($category->image) ?? asset('images/default-logo.png')  }}" alt="{{ $category->name }}" width="70"></td>
                            <td>{{ $category->name }}</td>
                            <td >
                                
                               
                                <button class="edit-btn" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-image="{{ Storage::url($category->image) }}" id="edit-{{ $category->id }}"> Edit </button>
                                
                                
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
    </div>



    <div class="container-create" style="display: none">

    
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

        
            <div class="form-group ">
            
                <label for="create-img">
                    <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(event, 'create-preview')" id="create-img">
                    <img src="{{ Storage::url($profiles->background_image) ?? asset('images/default-placeholder.png') }}" width="100" height="100" id="create-preview" alt="Image Preview"> Image
                </label>
                

                <div class="row">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
            </div>
            
            <div class="container-btn">

                <button  class="btn" type="button" id="cancel-create">Cancel</button>       
                <button type="submit" class="btn btn-primary">Add Category</button>
                
            </div>
        </form>
    </div> 


    <!-- Edit Category Modal -->
    <div class="edit-container" style="display: none">
        <form id="editCategoryForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit-id">

        
            <div class="form-group">
                <label for="edit-image">
                    <input type="file" class="form-control" id="edit-image" name="image" accept="image/*"  onchange="previewImage(event, 'edit-preview')">
                    <img id="edit-preview" src="" width="100" height="100">Image
                </label>

                <div class="row">
                    <label for="edit-name">Category Name</label>
                    <input type="text" class="form-control" id="edit-name" name="name" required>
                </div>
            </div>

            <div class="container-btn">
                <button type="button" class="btn " id="cancel-edit">Cancel</button>
                <button type="submit" class="btn " id="update-category-btn">Update Category</button>
            </div>
        </form>
    </div>
</div>
@endsection