@extends('layouts.app')
@section('content')
<div class="container">
    @if($posts->count() <= 0)
    <div class='text-primary d-flex justify-content-center'> <h3 style="color: --blue;">Start by following others!</h3> </div>
    @endif
    @foreach ($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
            <a href="/p/{{$post->id}}"><img src="/storage/{{ $post->image }}" class="w-100"></a>
        </div>
    </div>    

    <div class="row pt-2 pb-4">
        <div class="col-6 offset-3">
            <a class="pr-4" href="/like/p/{{$post->id}}">
                @if(in_array($post->id, $heart_ids))
                    <img src="/svg/hearted.png" class="pb-1" style="max-width: 28px"/>
                @else
                    <img src="/svg/heart.png" class="pb-1" style="max-width: 28px"/>
                @endif
            </a>
            <a href="/p/comment/{{$post->id}}"><img src="/svg/comment.png" class="pb-1" style="max-width: 28px"/></a>  
                <span class="float-right pr-1"> 
                <?php 
                    if($post->likedBy->count() <= 5){        
                        $array = [];
                        foreach($post->likedby as $like){
                            array_push($array, '<a href="profile/'.$like->id.'">'.$like->name.'</a>');
                        }
                        echo 'Liked by: ' . implode(', ', $array);
                    }
                    else
                    {
                        echo '<a href="/likedby/'.$post->id.'">'.$post->likedBy->count() . ' likes</a>';
                    }
                ?>

                </span>
                <div class='align-items-center d-flex'>
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
                @if($post->comments->count() > 4)
                    <a href="/p/{{$post->id}}">View Comments ({{$post->comments->count()}})</a>
                @else
                @foreach($post->comments as $comment)
                    <span class="font-weight-bold"><a href="/profile/{{$comment->user->id}}"><span class="text-dark">{{$comment->user->name}}</a></span></span>
                    {{$comment->comment}}
                    <br>
                @endforeach
                @endif
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
