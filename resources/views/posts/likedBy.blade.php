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
                <p>                
                    <span class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-dark">{{$post->user->userName}}</a></span></span>
                    {{$post->caption}}
                </p> 
                <hr>
                <p>                
                Liked by: 
                <?php
                    $array = [];
                    foreach($post->likedBy as $user){
                        array_push($array, '<a href="/profile/'.$user->id.'">'.$user->name.'</a> ');
                    }
                    echo implode(', ', $array);
                ?>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
