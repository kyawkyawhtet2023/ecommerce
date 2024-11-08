@extends('layouts.dashboard-app')

@section('content')
@vite('resources/css/app/dashboard/category/index.css')
@vite('resources/js/dashboard/category/index.js')
@vite('resources/js/dashboard/category/create.js')
<div class="container">
    <div class="container-show">
        
        <h1>Categories</h1> 
        <button type="button" class="create-btn" id="new-category">Add New Category</button>

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
                        
                        <td><img src="{{ Storage::url($category->image) ?? asset('images/default-logo.png')  }}" alt="{{ $category->name }}" width="70" height="70"></td>
                        <td>{{ $category->name }}</td>
                        <td >
                            
                            
                            <button class="edit-btn" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-image="{{ Storage::url($category->image) }}" id="edit-{{ $category->id }}"> Edit </button>
                            
                            
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" class="delete-category-form" data-id="{{ $category->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" id="delete-btn-{{ $category->id }}">Delete</button>
                            </form>
                            
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <x-categoryCreate />
    <x-categoryEdit />
   
</div>
@endsection