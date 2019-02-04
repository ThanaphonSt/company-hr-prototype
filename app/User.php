<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','level',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    // get called from AuthServiceProvider.php
    public function owns($user, $comment) 
    {
        return $user->id == $comment->user_id;  
    }
    public function isSuperAdmin($user) {
        return ( $user->level == 'admin' );
    }
    public function admin($user) 
    {
        return $user->level == 'admin';  
    }
}