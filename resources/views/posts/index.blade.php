@extends('layouts.app')
@section('content')
<div class="container">
    @if($posts->count() <= 0)
    <div class='text-primary d-flex justify-content-center'> <h3>Start by following others!</h3> </div>
    
    <div class="container">
 
    @endif
    @foreach ($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
            <a href="/profile/{{$post->user->id}}"><img src="/storage/{{ $post->image }}" class="w-100"></a>
        </div>
    </div>    

    <div class="row pt-2 pb-4">
        <div class="col-6 offset-3">
            <div>
                <a class="pr-4" href="#"><img src="/svg/heart.png" class="pb-1" style="max-width: 28px"/></a><a href="/p/comment/{{$post->id}}"><img src="/svg/comment.png" class="pb-1" style="max-width: 28px"/></a>
                <div class='d-flex align-items-center'>
                    <div class="pr-2 pb-3"> 
                        <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle" style="width : 40px;">
                    </div>
                    <div>
                        <p>                
                        <span class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-dark">{{$post->user->userName}}</a></span></span>
                        {{$post->caption}}
                        </p>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
