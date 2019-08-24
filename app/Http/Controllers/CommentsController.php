<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(\App\Post $post)
    {
        $data = request()->validate([
            'comment' => 'required',
          ]);

        auth()->user()->comments()->create([
            'comment' => $data['comment'],
            'post_id' =>  $post->id
           ]);        
        $user= auth()->user();
        return redirect('/profile/' . auth()->user()->id);
    }

    public function createComment(\App\Post $post)
    {
        $user= auth()->user();
        return view('comments/createComment', compact('user', 'post'));
    }
}
