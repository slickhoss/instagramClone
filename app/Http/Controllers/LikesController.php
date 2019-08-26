<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store (Post $post)
    {
        //toggles relationship between users likes and post object
        auth()->user()->likes()->toggle($post);
        return redirect('/');

    }
}
