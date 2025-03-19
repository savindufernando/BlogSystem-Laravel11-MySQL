<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'index', 'show', 'update', 'destroy']);
    }

    // Create a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return response()->json($post, 201);
    }

    // List all posts by authenticated user
    public function index()
    {
        $posts = Auth::user()->posts; // Only posts created by the authenticated user
        return response()->json($posts);
    }

    // Show a specific post
    public function show($id)
    {
        $post = Post::findOrFail($id);

        // Ensure the post belongs to the authenticated user
        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($post);
    }

    // Update a specific post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Ensure the post belongs to the authenticated user
        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($post);
    }

    // Delete a specific post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Ensure the post belongs to the authenticated user
        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    // Bonus: Search posts by title
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $posts = Post::where('title', 'like', '%' . $request->query . '%')
            ->where('user_id', Auth::id()) // Filter by authenticated user
            ->get();

        return response()->json($posts);
    }
}
