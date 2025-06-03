<?php

namespace App\Models;

use App\Notifications\MedalAwardedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\DatabaseNotification;
use App\Services\UserRewardService;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'role',
        'terms_accepted',
        'terms_accepted_at',
        'xp',
        'level',
        'first_login',
        'is_pending_deletion',
        'deletion_requested_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
        'first_login' => 'boolean',
    ];

    // RELACIONAMENTOS
    public function medals()
    {
        return $this->belongsToMany(Medal::class, 'user_medals')
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }

    public function disciplinesParticipant()
    {
        return $this->belongsToMany(Discipline::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'discipline_user');
    }

    public function disciplinePreferences()
    {
        return $this->hasMany(DisciplinePreference::class);
    }

    public function preferredDisciplines()
    {
        return $this->belongsToMany(DisciplinePreference::class);
    }

    public function missionFeedbacks()
    {
        return $this->hasMany(MissionFeedback::class);
    }

    public function trailFeedbacks()
    {
        return $this->hasMany(TrailFeedbacks::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badges::class, 'user_badges')->withTimestamps();
    }

    public function missions()
    {
        return $this->belongsToMany(Mission::class, 'mission_user')
                    ->withPivot('xp_earned', 'completed_at')
                    ->withTimestamps();
    }

    public function missionProgresses()
    {
        return $this->hasMany(MissionUserProgress::class);
    }

    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable');
    }

    protected static function booted()
    {
        static::created(function ($user) {
            app(UserRewardService::class)->initializeNewUser($user);
        });

        static::deleting(function ($user) {
            $user->notifications()->delete();
        });
    }

    public function hasMedal(Medal $medal): bool
    {
        return $this->medals()->where('medal_id', $medal->id)->exists();
    }

    public function awardMedal(Medal $medal): void
    {
        // Evita atribuir medalha duplicada
        if (!$this->medals()->where('medal_id', $medal->id)->exists()) {
            $this->medals()->attach($medal->id);

            // Notificação, se desejar
            $this->notify(new MedalAwardedNotification ($medal));
        }
    }

    public function completedMissions() {
        return $this->belongsToMany(Mission::class)->withTimestamps()->withPivot('completed_at');
    }

    

}
