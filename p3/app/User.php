<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Student;

class User extends Authenticatable
{
    use Notifiable;

    //RELATIONSHIPS - Many to Many
    //add a Student in the User model
    public function students()
    {
        return $this->belongsToMany('App\Student')
            ->withTimestamps() # Must be added to have Eloquent update the created_at/updated_at columns in a pivot table
            ->withPivot(['timeVolunteered']); # Must also specify any other fields that should be included when fetching this relationship
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'firstName', 'lastName', 'phone', 'streetAddress', 'accountType', 'password'
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
}
