<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        $user_id = Auth::user()->getAuthIdentifier();
//        dd($user_id);
//        dd($validated['content']);
        $comment = Comment::create([
            'text' => $validated['text'],
            'user_id' => $user_id,
            'post_id' => $validated['post_id'],
        ]);
        return response()->json($comment);
    }
}
