<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('title', 'Show Post')

@section('content')

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Show Product</h1>

            <!-- Back Button aligned to the right -->
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
        </div>
        <p><strong>Name:</strong> {{ $post->name }}</p> <!-- Display the post name -->
        <p><strong>Price:</strong> RM{{ $post->price }}</p> <!-- Display the price -->
        <p><strong>Details:</strong> {{ $post->details }}</p> <!-- Display the details -->
        <p><strong>Publish:</strong> {{ $post->publish ? 'Yes' : 'No' }}</p> <!-- Show publish status -->
@endsection

