<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    public function store($id)
    {
        $post = Post::find($id);
        $comment = new Comment();
        if (request()->content) {
            $comment->content = request()->content;
            $post->Comments()->save($comment);
        }

        return view('post.show', ['post' => $post]);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $commentable = $comment->commentable;

        $comment->delete();

        return view('post.show', ['post' => $commentable]);
    }
    public function update($id)
    {
        $comment = Comment::find($id);
        if ($comment->content != request()->new_content) {
            $comment->content = request()->new_content;
        }
        $comment->save();
        $commentable = $comment->commentable;
        return view('post.show', ['post' => $commentable]);
    }
}
