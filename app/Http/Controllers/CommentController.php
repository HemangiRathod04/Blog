<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Post $post)
    {
        $comments = Comment::with(['user', 'post'])->get();
        return view('user.comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'post_id' => $request->post_id,
        ]);

        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'user' => [
                'name' => $comment->user->name,
            ],
            'created_at' => $comment->created_at->diffForHumans(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->only(['content']));

        return response()->json([
            'content' => $comment->content,
            'updated_at' => $comment->updated_at->diffForHumans(), 
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['success' => true]);
    }
}
