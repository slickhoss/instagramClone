<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\NewUserMail;

class User extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;//set incrementing to false, using uuids
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'userName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user){
            $user->{$user->getKeyName()} = (string) Str::uuid();
        });

        static::created(
            function ($user)
            {
                $user->profile()->create(
                    ['title' => $user->userName]);
                    $user->following()->toggle($user->profile);
                    $user->profile->id = $user->id;
                Mail::to($user->email)->send(new NewUserMail());

            });
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function following ()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::Class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
