<!-- resources/views/posts/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Add New Product</h1>

            <!-- Back Button aligned to the right -->
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
        </div>
        
        <!-- To submit new form -->
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label" >Name:</label>
                <input type="text"  name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
            <div>
                <label for="price" class="form-label" >Price (RM):</label>
                <input type="text" name="price" id="price" class="form-control" placeholder="e.g 99.90" pattern="^\d+(\.\d{1,2})?$" required>
                <small id="price-error" class="text-danger" style="display:none;">Please enter a valid price (up to two decimal places).</small>
            </div>
            <div class="mb-3">
                <label for="details" class="form-label" >Detail:</label>
                <textarea name="details"  id="details" class="form-control" placeholder="Detail" required></textarea>
            </div>

            <div class="mb-3">
                <label for="publish" class="form-label">Publish:</label>
                
                <div class="form-check">
                    <input type="radio" id="publish_yes" name="publish" value="1" class="form-check-input" required>
                    <label for="publish_yes" class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="publish_no" name="publish" value="0" class="form-check-input" required>
                    <label for="publish_no" class="form-check-label">No</label>
                </div>
            </div>

            <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
@endsection

</body>
</html>

