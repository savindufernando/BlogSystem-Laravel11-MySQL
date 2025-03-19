@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-5">
    <!-- Form to create a new post -->
    <div class="mb-8">
        <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">Create New Post</a>
    </div>

    <!-- Toggle Buttons for All Posts and My Posts -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-blue-800">Posts</h1>
        <div class="mt-4">
            <button id="allPostsBtn" class="px-4 py-2 bg-blue-600 text-white rounded-l-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">All Posts</button>
            <button id="myPostsBtn" class="px-4 py-2 bg-green-200 text-gray-700 rounded-r-lg hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-gray-400">My Posts</button>
        </div>
    </div>

    <!-- Display All Posts or My Posts -->
    <div id="postsContainer" class="space-y-6">
        @foreach($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row gap-6 post all-posts">
                @if($post->main_image)
                    <img src="{{ asset('storage/' . $post->main_image) }}" class="h-32 w-32 md:w-48 md:h-48 rounded-lg object-cover" alt="Post Image">
                @endif
                <div class="flex-1">
                    <div class="flex items-center gap-3">
                        <p class="text-sm text-gray-500">{{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
                    </div>
                    <h2 class="mt-2 text-xl font-bold text-gray-900 hover:text-blue-600">
                        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="mt-2 text-gray-600">{!! $post->content !!}</p>

                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center gap-4">
                            <span>👀 26</span>
                            <span>💬 1</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- My Posts Section -->
    <div id="myPostsContainer" class="space-y-6 hidden">
        @foreach($myPosts as $post)
            <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row gap-6 post my-posts">
                @if($post->main_image)
                    <img src="{{ asset('storage/' . $post->main_image) }}" class="h-32 w-32 md:w-48 md:h-48 rounded-lg object-cover" alt="Post Image">
                @endif
                <div class="flex-1">
                    <div class="flex items-center gap-3">
                        <p class="text-sm text-gray-500">{{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
                    </div>
                    <h2 class="mt-2 text-xl font-bold text-gray-900 hover:text-blue-600">
                        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="mt-2 text-gray-600">{!! $post->content !!}</p>
                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center gap-4">
                            <span>👀 26</span>
                            <span>💬 1</span>
                        </div>
                        @if($post->user_id === auth()->id())
                            <div class="flex gap-2">
                                <a href="{{ route('posts.edit', $post->id) }}" class="text-yellow-600 hover:text-yellow-700">🖊️</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">❌</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Toggle between All Posts and My Posts
    document.getElementById('allPostsBtn').addEventListener('click', function() {
        document.getElementById('postsContainer').classList.remove('hidden');
        document.getElementById('myPostsContainer').classList.add('hidden');
        this.classList.add('bg-blue-600', 'text-white');
        this.classList.remove('hover:bg-blue-700');
        document.getElementById('myPostsBtn').classList.add('bg-gray-200', 'text-gray-700');
        document.getElementById('myPostsBtn').classList.remove('bg-gray-100', 'text-gray-600');
    });

    document.getElementById('myPostsBtn').addEventListener('click', function() {
        document.getElementById('postsContainer').classList.add('hidden');
        document.getElementById('myPostsContainer').classList.remove('hidden');
        this.classList.add('bg-blue-600', 'text-white');
        this.classList.remove('hover:bg-blue-700');
        document.getElementById('allPostsBtn').classList.add('bg-gray-200', 'text-gray-700');
        document.getElementById('allPostsBtn').classList.remove('bg-gray-100', 'text-gray-600');
    });
</script>

@endsection
