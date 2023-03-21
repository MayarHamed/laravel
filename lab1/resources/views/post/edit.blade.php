@extends('layouts.app')

@section('title')
Update
@endsection

@section('content')
<!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

<form method="post" action="{{route('posts.update', $post->id)}}" style="margin-top: 40px;">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input name="title" type="text" value="{{$post->title}}" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$post->description}}</textarea>
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
        <select name="post_creator" class="form-control">
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Update</button>
</form>

@endsection