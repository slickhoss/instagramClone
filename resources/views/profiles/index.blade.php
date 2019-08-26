@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{$user->profile->profileImage()}}"class='rounded-circle' style="width : 125px;">
        </div>
        <div class="col-9 pt-5">
            <div class='d-flex justify-content-between align-items-baseline'>
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->userName}}</div>
                    @cannot('update', $user->profile)
                    <follow-button user-id="{{$user->id}}" follows="{{ $follows }}"></follow-button>
                    @endcan
                </div>
                @can('update', $user->profile)
                    <a href="/p/create">Add new Post</a>
                @endcan
            </div>

                @can('update', $user->profile)
                    <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
                @endcan

                <div class="d-flex">
                    <div class='pr-3'><strong>{{ $postsCount }}</strong> posts</div>
                    <div class='pr-3'><strong>{{ $followersCount }}</strong> followers</div>
                    <div class='pr-3'><strong>{{ $followingCount}}</strong> following</div>
                </div>
                <div> {{ $user->profile->title }} </div>
                <div> {{ $user->profile->description }} </div>
                <div><a href='http://hoongandre.ca'> {{ $user->profile->url }} </a></div>
            </div>
    </div>
        @if($user->posts->count() <= 0)
        <hr>
         <div class='text-primary d-flex justify-content-center'> <h3 style="color: --blue;">Submit your first post!</h3> </div>
        @endif

    <div class='row pt-5'>

    @foreach($user->posts as $post)
        <div class='col-4 pb-4'>
            <a href="/p/{{$post->id}}"> <img src="/storage/{{ $post->image }}" class="w-100"> </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
