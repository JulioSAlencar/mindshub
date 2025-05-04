<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function preferences()
    {
        return $this->hasMany(DisciplinePreference::class);
    }

    public function usersWhoPrefer()
    {
        return $this->belongsToMany('App\Models\DisciplinePreference');
    }

    public function contents()
    {
        return $this->hasMany(ContentDiscipline::class);
    }

}
