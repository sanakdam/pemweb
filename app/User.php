<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable {
    use \Illuminate\Auth\Authenticatable;

    protected $table = "users";

    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'birth_date',
        'site',
        'bio',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function likes() {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function comment() {
        return $this->hasMany('App\Comment');
    }


    public function isFollowed()
    {
        return (boolean) $this->followers()
            ->where('follower_id', auth()->user()->id)->count();
    }
    public function getDashboardPostIds()
    {
        return $this->followings()->get()->pluck('id')->push($this->id);
    }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id');
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function message() {
        return $this->belongsToMany('App\Message');
    }
}
