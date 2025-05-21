<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'role',
        'terms_accepted',
        'terms_accepted_at',
        'xp',
        'level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }

    public function disciplines()
    {
        return $this->hasMany('App\Models\Discipline');
    }

    public function disciplinesParticipant()
    {
        return $this->belongsToMany('App\Models\Discipline');
    }

    public function medals() 
    {
        return $this->belongsToMany('App\Models\Medal');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'discipline_user'); // ou o nome correto da sua tabela pivot
    }


    public function disciplinePreferences() 
    {
        return $this->hasMany(DisciplinePreference::class);
    }

    public function preferredDisciplines()
    {
        return $this->belongsToMany('App\Models\DisciplinePreference');
    }

    public function missionFeedbacks() {
        return $this->hasMany(MissionFeedback::class);
    }

    public function trailFeedbacks() {
        return $this->hasMany(TrailFeedbacks::class);
    }

    public function badges(){
    return $this->belongsToMany(Badges::class, 'user_badges')->withTimestamps();
}

    public function missions()
    {
        return $this->belongsTo(Mission::class)
                    ->withPivot('xp_earned', 'completed_at')
                    ->withTimestamps();
    } 

    public function calculateTotalXP() 
    {
        return $this->missions()->sum('mission_user.xp_earned');
    }

    public function gainXp($amount) 
    {
        $this->xp += $amount;
        $this->level = floor($this->xp / 100) + 1;
        $this->save();
    }

    public function missionProgresses()
    {
        return $this->hasMany(MissionUserProgress::class);
    }

}
