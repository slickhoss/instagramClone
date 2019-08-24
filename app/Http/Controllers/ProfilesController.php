<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postsCount = Cache::remember(
            'count.posts'. $user->id, 
            now()->addSecond(30),
            function() use($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers'. $user->id, 
            now()->addSecond(30),
            function() use($user) {
                return $user->profile->followers->count() - 1;
            });
        
        $followingCount = Cache::remember(
            'count.following'. $user->id, 
            now()->addSecond(30),
            function() use($user) {
                return $user->following->count() - 1;
            });

        //$user = User::findOrFail($userId);//returns user object by found by id

        return view('profiles/index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }
    
    public function edit(\App\User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request() -> validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => ''
        ]);

            if(request('image'))
            {
                $imagePath = (request('image')->store('profile', 'public'));    
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
                $image->save(); //save image after modifying

                $imageArray = ['image' => $imagePath];
            }

        auth()->user()->profile->update(array_merge($data, $imageArray ?? [] ));
        return redirect("/profile/" . $user->id);
        dd($data);
    }
}
