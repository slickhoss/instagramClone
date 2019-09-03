@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="align-items-center d-flex border border-light rounded justify-content-center">
                    <img src="/svg/explore.png" class="rounded-circle" style="width : 60px">
                    <h4 class="font-weight-bold pl-1">Explore: </h3>
                </div>
                @foreach($userCollection as $user)
                @if($user->id == auth()->user()->id)
                    @continue
                @endif
                    <a href="/profile/{{$user->id}}">
                        <div class="border border-light rounded p-2 d-flex justify-content-between">
                            <img src="{{$user->profile->profileImage()}}" class="rounded-circle" style="width : 40px;">        
                            <span class="font-weight-bold pt-2 pl-4"><span class="text-dark">{{$user->userName}}</span></span>  
                            @if(auth()->user()->following->contains('user_id', $user->id))
                            <follow-button user-id="{{$user->id}}" follows="true"></follow-button>
                            @else
                            <follow-button user-id="{{$user->id}}" follows=""></follow-button>
                            @endif
                        </div>
                        
                    </a>
                @endforeach
            </div>
        </div>
    </div>                
@endsection