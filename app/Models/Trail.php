<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrailFeedback;
use App\Models\Mission;


class Trail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    /**
     * Uma trilha pode ter vários feedbacks.
     */
    public function feedbacks()
    {
        return $this->hasMany(TrailFeedbacks::class);
    }

    /**
     * Uma trilha pode conter várias missões.
     */
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }
}