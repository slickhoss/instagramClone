@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-6 offset-3">
            <a href="/profile/{{$post->user->id}}"><img src="/storage/{{ $post->image }}" class="w-100"></a>
        </div>
    </div>    

    <div class="row pt-2 pb-4">
        <div class="col-6 offset-3">
            <div>
                <a class="pr-4" href="#"><img src="/svg/heart.png" class="pb-1" style="max-width: 28px"/></a><a href="/profile/1"><img src="/svg/comment.png" class="pb-1" style="max-width: 28px"/></a>
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
                <form action="/p/comment/{{$post->id}}/store" enctype="multipart/form-data" method="post">
                    @csrf 
                    <div class="form-group">
                        <input id="comment" placeHolder="Comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment"  required autocomplete="comment" autofocus>
                        @error('comment')
                                <strong>{{ $message }}</strong>
                            @enderror
                        <div class="pt-2">
                           <button class="btn btn-primary"> Post </button> 
                        </div>    
                    </div>
                </form>
                @csrf 

            </div>
        </div>
    </div>
    <hr>
@endsection
