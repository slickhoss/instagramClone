<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $hearts = auth()->user()->likes;
        $heart_ids = [];
        foreach($hearts as $heart)
        {
            array_push($heart_ids, $heart->pivot->post_id);
        }
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts', 'heart_ids'));
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        $imagePath = (request('image')->store('uploads', 'public'));    
        //using intervention image we will refit uploaded image
        //create the image using make function and call fit function with width and height
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save(); //save image after modifying

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath 
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
        $user = $post->user();
        $heart_ids = [];
        foreach(auth()->user()->likes as $like)
        {
            array_push($heart_ids, $like->pivot->post_id);
        }
        return view('posts/show', compact('post', 'user', 'heart_ids'));
    }

    public function likedBy (\App\Post $post)
    {
        $user = $post->user();
        return view('posts/likedBy', compact('post', 'user'));
    }

    public function delete( \App\Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
