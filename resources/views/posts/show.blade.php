@extends('layouts.app')

@section('content')

    <div>
        <h2> Show Post</h2>
    </div>
    <div>
        <a href="{{ route('posts.index') }}"> Back</a>
    </div>

    <div class="form-group">
        <strong>Title:</strong>
        {{ $post->title }}
    </div>

    <div>
        <strong>Image:</strong>
        {{ $post->image }}
    </div>

    <div>
        <strong>Category:</strong>
        <a href="{{ route('category.show', ['category' => $post->category->id]) }}">
            {{ $post->category->title}}
        </a>
    </div>

    <div>
        <strong>Posted By:</strong>
        <a href="{{ route('posts.index') }}">
            {{ $post->postedBy->email }}
        </a>
    </div>

@endsection
