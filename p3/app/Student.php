<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\User;

class Student extends Model
{
    //RELATIONSHIPS - Many to Many
    //add a User in the Student model
    public function users()
    {
        return $this->belongsToMany('App\User')
            ->withTimestamps() # Must be added to have Eloquent update the created_at/updated_at columns in a pivot table
            ->withPivot(['timeVolunteered']); # Must also specify any other fields that should be included when fetching this relationship
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @vararray
     */

    protected $fillable = [
        'firstName', 'lastName', 'homeroom', 'streetAddress'
    ];
}
