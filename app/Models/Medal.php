<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',
        'xp_required',
    ];

    // 🔗 Usuários que ganharam essa medalha
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_medals')
                    ->withTimestamps()
                    ->withPivot('achieved_at');
    }

    public function addXp(int $amount) 
    {
        $this->xp += $amount;

        $levelBefore = $this->level;
        $this->level = $this->calculateLevel($this->xp);

        $this->save();
    }

    private function calculateLvel() 
    {
        return (int) floor($xp / 100) + 1;
    }

    private function checkForNewMedals() 
    {
        $availableMedals = Medal::where('xp_required', '<=', $this->xp)->get();

        foreach($availableMedals as $medal) {
            if(!$this->medals->contains($medal->id)) {
                $this->medal()->attach($medal->id, ['archieved_at' => now()]);
            }
        }
    }
}
