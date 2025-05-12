<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public function missions()
{
    return $this->belongsToMany(Mission::class, 'material_mission');
}
}
