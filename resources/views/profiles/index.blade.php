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
                    <follow-button user-id="{{$user->id}}" follows="{{ $follows }}"></follow-button>
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
    <div class='row pt-5'>
        @foreach($user->posts as $post)
        <div class='col-4 pb-4'>
            <a href="/p/ {{$post->id}}"> <img src="/storage/{{ $post->image }}" class="w-100"> </a>
        </div>
        @endforeach

        <div class='col-4'>
            <img src="https://instagram.fyvr3-1.fna.fbcdn.net/vp/52b5643661bdad35e783fdea348ef9c4/5DCEB1CE/t51.2885-15/e35/c0.109.925.925a/s150x150/66056371_2243301639072331_4740487891029112385_n.jpg?_nc_ht=instagram.fyvr3-1.fna.fbcdn.net" class="w-100">
        </div>
        <div class='col-4'>
            <img src="https://instagram.fyvr3-1.fna.fbcdn.net/vp/52b5643661bdad35e783fdea348ef9c4/5DCEB1CE/t51.2885-15/e35/c0.109.925.925a/s150x150/66056371_2243301639072331_4740487891029112385_n.jpg?_nc_ht=instagram.fyvr3-1.fna.fbcdn.net" class="w-100">
        </div>
        <div class='col-4'>
            <img src="https://instagram.fyvr3-1.fna.fbcdn.net/vp/52b5643661bdad35e783fdea348ef9c4/5DCEB1CE/t51.2885-15/e35/c0.109.925.925a/s150x150/66056371_2243301639072331_4740487891029112385_n.jpg?_nc_ht=instagram.fyvr3-1.fna.fbcdn.net" class="w-100">
        </div>
    </div>
</div>
@endsection
