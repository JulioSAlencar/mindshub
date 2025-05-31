<?php

namespace Database\Seeders;

use App\Models\Medal;
use App\Services\UserRewardService;
use Illuminate\Database\Seeder;

class MedalSeeder extends Seeder
{
    public function run(): void
    {
        $levelXpRequirements = app(UserRewardService::class)->getLevelXpRequirementsMapping();

        $medals = [
            [
                'name' => 'Início',
                'description' => 'Você começou sua jornada com sucesso!',
                'icon' => 'assets/medals/Medal_Level_1.svg',
                'level' => 1,
            ],
            [
                'name' => 'Aventureiro Nível 10',
                'description' => 'Parabéns por alcançar o Nível 10!',
                'icon' => 'assets/medals/Medal_Level_10.svg',
                'level' => 10,
            ],
            [
                'name' => 'Explorador Nível 25',
                'description' => 'Você desbravou caminhos e alcançou o Nível 25!',
                'icon' => 'assets/medals/Medal_Level_25.svg',
                'level' => 25,
            ],
            [
                'name' => 'Mestre Nível 50',
                'description' => 'Sua dedicação o levou ao Nível 50. Impressionante!',
                'icon' => 'assets/medals/Medal_Level_50.svg',
                'level' => 50,
            ],
            [
                'name' => 'Lenda Nível 100',
                'description' => 'Você é uma Lenda! Nível 100 alcançado!',
                'icon' => 'assets/medals/Medal_Level_100.svg',
                'level' => 100,
            ],
        ];

        foreach ($medals as $medal) {
            Medal::updateOrCreate(
                ['name' => $medal['name']],
                [
                    'description' => $medal['description'],
                    'icon' => $medal['icon'],
                    'xp_required' => $levelXpRequirements[$medal['level']] ?? 0,
                    'condition_type' => 'level',
                    'condition_value' => $medal['level'],
                ]
            );
        }
    }
}
