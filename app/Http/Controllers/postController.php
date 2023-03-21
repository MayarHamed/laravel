<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(7); //select * from posts

        return view('post.index', ['posts' => $allPosts]);
        
    }

    public function show($id)
    {
        //        $post = Post::find($id); //select * from posts where id = 1 limit 1;

        $postCollection = Post::where('id', $id)->get(); //Collection object .... select * from posts where id = 1;

        $post = Post::where('id', $id)->first(); //Post model object ... select * from posts where id = 1 limit 1;

        //        Post::where('title', 'Laravel')->first();

        return view('post.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();

        return view('post.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        //get the form data
        //        $data = request()->all();
        //
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        //        $data = $request->all();

        //insert the form data in the database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        //redirect to index route
        return to_route('posts.index');
    }

    public function edit($id)
    {
        $users = User::all();
        $post = Post::find($id);
        // dd($post);

        return view('post.edit', ['users' => $users, 'post' => $post]);
    }

    public function update($id)
    {
        $post = Post::find($id);

        $new_title = request()->title;
        $new_description = request()->description;
        $new_postCreator = request()->post_creator;

        if ($post->title != $new_title) {
            $post->title = $new_title;
        }
        if ($post->description != $new_description) {
            $post->description = $new_description;
        }
        if ($post->user_id != $new_postCreator) {
            $post->user_id = $new_postCreator;
        }

        $post->save();
        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();
        return to_route('posts.index');
    }
}

