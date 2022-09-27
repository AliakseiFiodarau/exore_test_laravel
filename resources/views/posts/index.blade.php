@extends('layouts.app')

@section('content')

        @if ($message = Session::get('success'))
            <div>
                <p>{{ $message }}</p>
            </div>
        @endif

        <table>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Category</th>
                @can('viewAsManager', auth()->user())
                    <th>Posted By</th>
                @endcan
            </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->image }}</td>
                    <td>
                        <a href="{{ route('posts.index', ['category_id' => $post->category->id]) }}">
                            {{ $post->category->title}}
                        </a></td>
                    @can('viewAsManager', auth()->user())
                    <td>
                        <a href="{{ route('posts.index', ['posted_by' => $post->postedBy->id]) }}">
                            {{ $post->postedBy->email }}
                        </a>
                    </td>
                    @endcan
                    <td>
                        <a href="{{ route('posts.show',$post->id) }}">Show</a>
                        @can('viewAsEmployee', auth()->user())
                            <a href="{{ route('posts.edit',$post->id) }}">Edit</a>
                        @endcan
                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST">

                        @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <div>
            {{$posts->withQueryString()->links()}}
        </div>

@endsection
