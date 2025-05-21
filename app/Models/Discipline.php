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

    public function students()
    {
        return $this->belongsToMany(User::class);
    }


    public function contents()
    {
        return $this->hasMany(ContentDiscipline::class);
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function disciplinesParticipant()
{
    return $this->belongsToMany(Discipline::class, 'user_id', 'discipline_id');
}

}
