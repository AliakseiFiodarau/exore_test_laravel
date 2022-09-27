@extends('layouts.app')

@section('content')

    <h3>Add New Post</h3>
    <a href="{{ route('posts.index') }}"> Back</a>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div>
            <strong>Title:</strong>
            <input type="text" name="title" placeholder="Title"/>
        </div>
        <div>
            <strong>Image:</strong>
            <input type="text" name="image" placeholder="Image"/>
        </div>
        <div>
            <strong>Category:</strong>
            <select name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach()
            </select>
        </div>

        <input type="hidden" value="{{$userId}}" name="posted_by"/>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

@endsection
