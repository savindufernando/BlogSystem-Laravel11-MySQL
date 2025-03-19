<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 500px;">
    @endif

    <a href="{{ route('posts.index') }}">Back to Posts</a>
</body>
</html>
