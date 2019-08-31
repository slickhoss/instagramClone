@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="align-items-center d-flex border border-light rounded">        
                <img src="{{$user->profile->profileImage()}}" class="rounded-circle" style="width : 60px;">
                <h4 class="font-weight-bold pl-3">Followers: </h4>
                <hr>
            </div>
    @foreach($user->profile->followers as $follower)
    @if($follower->id == auth()->user()->id)
        @continue
    @endif
        <a href="/profile/{{$follower->id}}">
            <div class="border border-light rounded pl-2 pt-2 pb-2">
                <img src="{{$follower->profile->profileImage()}}" class="rounded-circle" style="width : 40px;">        
                <span class="font-weight-bold"><span class="text-dark">{{$follower->userName}}</span></span>
            </div>
        </a>
    @endforeach
        </div>
    </div>
</div>
@endsection