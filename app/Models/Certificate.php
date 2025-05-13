<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'discipline_id', 'issued_at', 'certificate_path'];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function discipline() {
        return $this->belongsTo(Discipline::class);
    }
}
