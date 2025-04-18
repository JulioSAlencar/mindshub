<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisciplinePreference extends Model
{
    protected $fillable = ['user_id', 'discipline_id', 'interest_level'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discipline() 
    {
        return $this->belongsTo(Discipline::class);
    }
}
