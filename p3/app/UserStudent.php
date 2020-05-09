<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStudent extends Model
{
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
