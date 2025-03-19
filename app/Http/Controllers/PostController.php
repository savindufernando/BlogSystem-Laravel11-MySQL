<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // List all posts
    public function index()
    {
        // Fetch all posts and posts created by the authenticated user
        $posts = Post::all();
        $myPosts = Post::where('user_id', auth()->id())->get();  // Only posts by the authenticated user

        return view('posts.index', compact('posts', 'myPosts'));
    }


    // Show form to create a new post
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Add validation for image
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imagePath = $image->store('images/posts', 'public'); // Store in the public disk
        }

        // Create the post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),  // Add user_id for the authenticated user
            'main_image' => $imagePath, // Store the image path in the database
        ]);

        return redirect()->route('posts.index')->with('message', 'Post created successfully!');
    }
    // Show a specific post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show form to edit a post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update a post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($post->main_image) {
                Storage::disk('public')->delete($post->main_image);
            }

            $image = $request->file('main_image');
            $post->main_image = $image->store('images/posts', 'public');
        }

        // Update post
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('message', 'Post updated successfully!');
    }


    // Delete a post
    public function destroy($id)
    {
        // Fetch the post by ID
        $post = Post::findOrFail($id); // If post not found, it will throw a 404 error

        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post.');
        }

        // Delete the post
        $post->delete();

        // Redirect back to the posts index with a success message
        return redirect()->route('posts.index')->with('message', 'Post deleted successfully!');
    }


    public function myPosts()
    {
        $posts = auth()->user()->posts; // Assuming the relationship is defined in User model as 'posts'
        return view('posts.index', compact('posts'));
    }


}
