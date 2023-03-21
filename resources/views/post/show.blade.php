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
    </div>
    </div>
@endsection