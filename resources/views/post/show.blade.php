@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div style="margin-top: 40px;">
    <div class="card mt-6">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post->title}}</h5>
            <p class="card-text">Description: {{$post->description}}</p>
            <img src="{{Storage::url($post->image_path)}}" alt="{{Storage::path($post->image_path)}}" width="250px">
        </div>
    </div><br>

    <div class="card mt-6">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">User name: {{$post->user->name}}</h5>
            <p class="card-text">Email: {{$post->user->email}}</p>
            <p class="card-text">Created at: {{ date('l jS \o\f F Y h:i:s A', strtotime($post->created_at))}}</p>
        </div>
    </div><br>

    <div class="card mt-6">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">
            <table class="table mt-2">
                @foreach ($post->comments as $comment)
                <tr>
                    <td>{{$comment->content}}</td>
                    <td>{{date('Y-m-d h:i:s A', strtotime($comment->created_at))}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$comment['id']}}">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$comment['id']}}">
                            Delete
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="deleteModal{{$comment['id']}}">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this comment?
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('comments.destroy', $comment->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editModal{{$comment['id']}}">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('comments.update', $comment->id)}}" method="POST">
                                    @csrf
                                    @method('Put')
                                    <div>
                                        <input style="padding: 10px; border:1px solid lightgray;" name="new_content" value="{{$comment->content}}">
                                    </div><br>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </form>
                                <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </table>
            <div>
                <form method="POST" action="{{route('comments.store',$post->id)}}">
                    @csrf
                    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea><br>
                    <button class="btn btn-success">Post comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection