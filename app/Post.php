<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public $incrementing = false;
    protected $guarded = [];
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post){
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
