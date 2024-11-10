<!-- resources/views/posts/index.blade.php -->
@extends('layouts.app')

@section('title', 'List Post')

@section('content')
  
<!-- Success Message -->
@if(session('success'))
<div id="chatbox" class="chatbox">
    <div class="chatbox-content">
        <p>{{ session('success') }}</p>
        <button class="chatbox-close-btn" onclick="closeChatbox()">X</button>
    </div>
</div>

@endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Laravel</h1>

        <!-- Create Post Button -->
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Product</a>
    </div>

    <div class="d-flex justify-content-end mb-3" >
         <!-- Search Form -->
        <form method="GET" action="{{ route('posts.index') }}" class="d-flex w-100 justify-content-end" id="search-form">
            <input type="text" name="search" class="form-control me-2" placeholder="Search posts..." value="{{ $search }}" id="search-input" style="max-width: 300px;">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>

    <div class="mb-4">
        <!-- Display posts in a table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price (RM)</th>
                    <th>Details</th>
                    <th>Publish</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $index => $post)
                    <tr>
                        <td>{{ $index + 1 + (($posts->currentPage() - 1) * $posts->perPage()) }}</td> <!-- Display No (index) -->
                        <td>{{ $post->name }}</td> <!-- Display Name -->
                        <td>{{ $post->price }}</td> <!-- Display Price -->
                        <td>{{ $post->details }}</td> <!-- Display Details -->
                        <td>{{ $post->publish ? 'Yes' : 'No' }}</td> <!-- Display Publish status -->
                        <td>
                            <!-- Add Edit and Delete Actions -->
                            <!-- Show Button -->
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
     <!-- Pagination  -->
     <div class="d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-4')}}
     </div>
@endsection

@section('scripts')
   <!-- Optionally, include Bootstrap's JavaScript (for modals, dropdowns, etc.) -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to handle auto-submit when input is cleared -->
    <script>
        document.getElementById('search-input').addEventListener('input', function() {
            // If the input is empty, submit the form to get all posts
            if (this.value === '') {
                document.getElementById('search-form').submit();
            }
        });
    
        // Show the chatbox when the success message is available
        window.onload = function() {
            var chatbox = document.getElementById('chatbox');
            if (chatbox) {
                chatbox.classList.add('show');
                
                // Auto-hide the chatbox after 5 seconds
                setTimeout(function() {
                    closeChatbox();
                }, 5000);
            }
        };

        // Function to close the chatbox manually (clicking the close button)
        function closeChatbox() {
            var chatbox = document.getElementById('chatbox');
            if (chatbox) {
                chatbox.classList.remove('show');
            }
        }
    </script>
@endsection

@section('styles')
    <style>
        .border-container {
            border: 2px solid #000; /* Apply border to the entire container */
            padding: 20px; /* Add some space around the content */
        }
    
        /* Chatbox Container */
        .chatbox {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #28a745; /* Green background for success message */
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            max-width: 300px;
            display: none; /* Hide by default */
            font-family: Arial, sans-serif;
        }

        /* Chatbox Content */
        .chatbox-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chatbox-content p {
            margin: 0;
            padding-right: 20px; /* Space for close button */
        }

        /* Close Button */
        .chatbox-close-btn {
            background: none;
            border: none;
            color: white;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
        }

        /* Show Chatbox Animation */
        .chatbox.show {
            display: block;
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(100%);
            }
            100% {
                transform: translateY(0);
            }
        }
    </style>

@endsection
