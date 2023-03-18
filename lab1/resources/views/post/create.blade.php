@extends('layouts.app')


@section('title') Create @endsection

@section('content')

<container class="card " style="margin-top: 50px;padding: 10px;">
    <form method="post" action="{{route('posts.store')}}" style="padding: 10px;">
        @csrf
        Full Name
        <input type="text" style="margin-top: 20px;margin-left: 20px;" id="posted_by"><br>
        Title
        <input type="text" style="margin-top: 20px;margin-left: 20px;" id="title"><br>
        <div style="display:flex;align-items: center;">
            Description
            <textarea type="text" style="margin-top: 20px;margin-left: 20px;" id="description"></textarea><br>
        </div> <!-- <a href="{{route('posts.store')}}" class="mt-4 btn btn-success">Save Post</a> -->
        <button class="mt-4 btn btn-success">Save Post</button>

    </form>
</container>

<style>
input,textarea{
    border: 1px solid lightgray;
    border-radius: 5px;
    padding:5px;

}
</style>

@endsection