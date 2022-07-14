<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentForm;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->orderBy("created_at", "DESC")->paginate(6);
        return view('posts.index', [
            "posts" => $posts,
        ]);
    }

    public function show($id)
    {
        $post = Post::with("comments.user")->findOrFail($id);

        return view('posts.show', ["post" => $post]);
    }

    public function showCreatePostForm()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'preview' => $validated['preview'],

        ]);
        return response()->json($post);
    }
}
