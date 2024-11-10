<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->query('search');

        // To filter posts by name or price (for search)
        if ($search) {
            $posts = Post::where('name', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%')
                        ->paginate(10) // Paginate the search results
                        ->onEachSide(2); // Add 2 links on each side of the pagination
        } else {
            // If no search term, fetch all posts with pagination
            $posts = Post::paginate(10)
                        ->onEachSide(2); // Add 2 links on each side of the pagination
        }

        // Return the view with the posts and the search query (if any)
        return view('posts.index', compact('posts', 'search'));
    }

    // Function to show the form
    public function create()
    {
        return view('posts.create');
    }

    // To store the new data into database
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0|max:99999999999999.99|regex:/^\d+(\.\d{1,2})?$/', // Validates decimal number with up to 2 decimal places
            'details' => 'nullable',
            'publish' => 'required|boolean',
        ]);

        // Create a new post in the database (Eloquent's create method)
        Post::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'details' => $validated['details'],
            'publish' => $validated['publish'],
        ]);

        // Redirect to the posts list or another page with a success message
        return redirect()->route('posts.index')->with('success', 'Data created successfully');
    }

    // To show form to edit selected id
    public function edit($id)
    {
        $post = Post::findOrFail($id); // Find the post by ID
        return view('posts.edit', compact('post'));
    }   

    // To update the selested id in database
    public function update(Request $request, $id)
    {
        // Validate the incoming data 
        $validated = $request->validate([
            'name' => 'required|max:255',     // name is required and should not exceed 255 characters
            'price' => 'required|numeric',    // price is required and must be a number
            'details' => 'nullable',          // details is optional
            'publish' => 'required|boolean',  // publish should be either true or false (1 or 0)
        ]);

        // Find the post by id and update it
        $post = Post::findOrFail($id);  // This will return a 404 if not found

        // Update the post's attributes
        $post->update([
            'name' => $validated['name'],  // Update the name
            'price' => $validated['price'],  // Update the price
            'details' => $validated['details'],  // Update the details
            'publish' => $validated['publish'],  // Update the publish status (1 or 0)
        ]);

        // Redirect back to the posts list with a success message
        return redirect()->route('posts.index')->with('success', 'Data updated successfully');
    }

    // To show selected id
    public function show($id)
    {
        $post = Post::findOrFail($id); // Find the post by id or return 404 if not found
        return view('posts.show', compact('post')); // Pass the post data to the view
    }

    // To delete selected id from database
    public function destroy($id)
    {
        // Find the post by its id
        $post = Post::findOrFail($id);

        // Delete the post
        $post->delete();

        // Redirect back with a success message
        return redirect()->route('posts.index')->with('success', 'Data deleted successfully.');
    }
}
