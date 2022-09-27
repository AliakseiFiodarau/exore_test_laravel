<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing posts.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $this->authorize('viewAny', Post::class);

        $user->role === User::MANAGER
            ? $collection = Post::all()->filter(function ($post) {
            return $post->postedBy->manager === Auth::Id();
        })->toQuery() :
            $collection = Post::where('posted_by', '=', Auth::id());

        $posts = $collection->filter($request->all())->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a post.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::all();
        $usrId = Auth::id();

        return view('posts.create', ['categories' => $categories, 'userId' => $usrId]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $request->validate([
            Post::TITLE => 'required',
            Post::IMAGE => 'required',
            Post::CATEGORY_ID => 'required',
            Post::POSTED_BY => 'required'
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the post.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();

        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified post in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            Post::TITLE => 'required',
            Post::IMAGE => 'required',
            Post::CATEGORY_ID => 'required'
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post removed successfully.');
    }
}
