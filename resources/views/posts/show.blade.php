@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class='d-flex align-items-center'>
                    <div class="pr-2"> 
                        <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle" style="width : 45px;">
                    </div>
                    <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$post->user->id}}" class="pr-4"><span class="text-dark">{{$post->user->userName}}</span></a>            
                            <?php 
                            if($post->user->id == auth()->user()->id)
                            {
                             echo "<button class='btn btn-outline-danger'><a href='/p/delete/$post->id'>delete</a></button>";
                            }
                            ?>
                        </div>
                    </div>
                </div>     
                
                <div class="pt-2">
                @if(in_array($post->id, $heart_ids))
                    <img src="/svg/hearted.png" class="pb-1" style="max-width: 28px"/>
                @else
                    <img src="/svg/heart.png" class="pb-1" style="max-width: 28px"/>
                @endif
                <a href="/p/comment/{{$post->id}}" class="pl-2"><img src="/svg/comment.png" class="pb-1" style="max-width: 28px"/></a>  
                </div>
                <p>                
                    <span class="font-weight-bold"></span>{{$post->caption}}</span>
                </p> 
                <hr>
                <p>                
                @foreach($post->comments as $comment)
                    <span class="font-weight-bold"><a href="/profile/{{$comment->user->id}}"><span class="text-dark">{{$comment->user->name}}</a></span></span>
                    {{$comment->comment}}
                    <br>
                @endforeach
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
