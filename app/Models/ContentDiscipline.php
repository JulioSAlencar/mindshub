<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentDiscipline extends Model
{
    protected $fillable = [
        'discipline_id', 
        'title', 
        'file_path', 
        'file_type', 
        'file_size'
    ];
    
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
}
