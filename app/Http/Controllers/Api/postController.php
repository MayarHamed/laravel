<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Str;
use App\Http\Resources\PostResource;


class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::all()->paginate(7);
        return PostResource::collection($allPosts);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return new PostResource($post);
    }
}
