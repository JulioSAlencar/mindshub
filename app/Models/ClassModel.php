<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'discipline_id',
        'max_students',
    ];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_model_user')
                    ->withTimestamps();
    }
}
