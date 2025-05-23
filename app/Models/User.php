<?php

namespace App\Models;

use App\Http\Controllers\NotificationController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Notifications\MedalAwardedNotification;
use Illuminate\Notifications\DatabaseNotification;

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

    public function medals()
    {
        return $this->belongsToMany(Medal::class, 'user_medals')
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }

    public function hasMedal(Medal $medal): bool
    {
        return $this->medals()->where('medal_id', $medal->id)->exists();
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
        static::deleting(function ($user) {
            $user->notifications()->delete();
        });
    }

    // Lógica que deveria ir para um service

    public function addXp(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $amount = $request->input('xp');

        $user->gainXp($amount);

        return redirect()->back()->with('message', 'XP adicionado!');
    }

    public function gainXp(int $amount): void
    {
        if ($amount <= 0) return;

        $this->xp += $amount;
        $levelBefore = $this->level;
        $this->level = $this->calculateLevelFromXp($this->xp);
        $this->save();

        $this->syncMedalsByLevel();
        $this->checkAndAwardMedals();

        if ($this->level > $levelBefore) {
            Session::flash('level_up', 'Parabéns! Você subiu para o Nível ' . $this->level . '!');
        }
    }

    public static function getLevelXpRequirementsMapping(): array
    {
        $xpMap = [1 => 1];
        for ($level = 2; $level <= 100; $level++) {
            $ratio = ($level - 1) / 99;
            $xpMap[$level] = 1 + intval(pow($ratio, 2) * (10000 - 1));
        }
        return $xpMap;
    }


    public function calculateLevelFromXp(int $xp): int
    {
        if ($xp <= 0) return 1;

        $levelMap = $this->getLevelXpRequirementsMapping();
        krsort($levelMap);

        foreach ($levelMap as $level => $requiredXp) {
            if ($xp >= $requiredXp) {
                return $level;
            }
        }

        return 1;
    }

    public function checkAndAwardMedals()
    {
        $newlyAwardedMedals = [];
        $currentUserLevel = $this->level;

        $potentialMedals = \App\Models\Medal::where('condition_type', 'level')
            ->where('condition_value', '<=', $currentUserLevel)
            ->orderBy('condition_value', 'asc')
            ->get();

        foreach ($potentialMedals as $medal) {
            if (!$this->hasMedal($medal)) {
                $this->medals()->attach($medal->id, ['earned_at' => now()]);
                $newlyAwardedMedals[] = $medal;

                // 🔔 Dispara a notificação
                $this->notify(new MedalAwardedNotification($medal));
            }
        }

        if (!empty($newlyAwardedMedals)) {
            $messages = [];
            foreach ($newlyAwardedMedals as $medal) {
                $iconHtml = $medal->icon ? "<img src='" . asset($medal->icon) . "' alt='{$medal->name}' style='width: 24px;'>" : "🏅 ";
                $messages[] = $iconHtml . " <strong>{$medal->name}</strong>: {$medal->description}";
            }
            Session::flash('awarded_medals_messages', $messages);
        }
    }


    public function syncMedalsByLevel(): void
    {
        // Pega todas as medalhas do tipo "level" até o nível atual do usuário
        $medalsToAssign = Medal::where('condition_type', 'level')
            ->where('condition_value', '<=', $this->level)
            ->get();

        foreach ($medalsToAssign as $medal) {
            // Verifica se o usuário já tem a medalha
            if (!$this->medals()->where('medal_id', $medal->id)->exists()) {
                // Atribui a medalha ao usuário (assumindo relacionamento many-to-many)
                $this->medals()->attach($medal->id);
            }
        }
    }
    public function awardMedal(Medal $medal)
    {
        if (!$this->hasMedal($medal)) {
            $this->medals()->attach($medal->id, ['earned_at' => now()]);
            $this->notify(new MedalAwardedNotification($medal));
        }
    }

    public function verificarMedalhas()
    {
        $medalhas = Medal::where('condition_type', 'level')
            ->where('condition_value', '<=', $this->level)
            ->get();

        foreach ($medalhas as $medalha) {
            if (!$this->medals->contains($medalha->id)) {
                $this->medals()->attach($medalha->id);
                $this->notify(new MedalAwardedNotification($medalha));
            }
        }
    }

}
