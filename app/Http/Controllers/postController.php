<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Str;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $path = null;
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        if (request()->avatar) {
            $path = request()->avatar->store('avatars', 'public');
        }

        $slug = Str::slug($title);

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            'image_path' => $path
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
        if (request()->avatar) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
                // dd("deleted");
            }
            $path = request()->avatar->store('avatars', 'public');
            $post->image_path = $path;
        }

        $post->save();
        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->image_path) {
            Storage::delete($post->image_path);
            // dd("deleted");

        }
        $post->delete();
        return to_route('posts.index');
    }

    public function removeOldPosts()
    {
        PruneOldPostsJob::dispatch();
        return to_route('posts.index');
    }
}
