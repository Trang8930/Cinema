<?php

namespace App\Models;

use App\Models\Film;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Schedule;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, CascadeSoftDeletes;

    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;
    const IS_ADMIN = 1;
    const IS_USER = 0;
    const ID_MASTER = 1;

    protected $cascadeDeletes = ['comments', 'favorites', 'borrowings'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'email', 
        'password',
        'fullname',
        'image',
        'birthday',
        'role',
        'is_active',
        'access_token',
        'city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'access_token'
    ];

    /**
     * The user that belong to the schedules.
     */
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }

    /**
     * The user that belong to the films.
     */
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

    /**
     * Get the comments for user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the borrowings for user.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Get the favorites for user.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    /**
     * Get the city that owns the user.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
