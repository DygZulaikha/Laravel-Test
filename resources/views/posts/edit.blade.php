<!-- resources/views/posts/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Edit Product</h1>

            <!-- Back Button aligned to the right -->
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
        </div>
        <!-- Edit Post Form -->
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- for updating data -->

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" value="{{ old('name', $post->name) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" name="price" value="{{ old('price', $post->price) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="details" class="form-label">Details:</label>
                <textarea name="details" class="form-control">{{ old('details', $post->details) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="publish" class="form-label">Publish:</label>
                
                <div class="form-check">
                     <input type="radio" name="publish" value="1" id="publish_yes" class="form-check-input" {{ $post->publish ? 'checked' : '' }}> 
                     <label for="publish_yes" class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                     <input type="radio" name="publish" value="0" id="publish_no" class="form-check-input" {{ !$post->publish ? 'checked' : '' }}> 
                     <label for="publish_no" class="form-check-label">No</label>
                </div>
            </div>

            <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
@endsection