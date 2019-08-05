<?php

namespace App\Http\Controllers;

use App\Post;
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
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
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
        return view('posts/show', ['post' => $post]);
    }
}
