<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Auth\Events\Validated;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(7); //select * from posts

        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {

        $post = Post::where('id', $id)->first(); 

        return view('post.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();

        return view('post.create', ['users' => $users]);
    }

    public function store(StorePostRequest $request)
    {
        $valid_request = $request->validated();

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

       
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return to_route('posts.index');
    }

    public function edit($id)
    {
        $users = User::all();
        $post = Post::find($id);

        return view('post.edit', ['users' => $users, 'post' => $post]);
    }

    public function update($id, StorePostRequest $request)
    {
        $valid_request = $request->validated();
        
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
