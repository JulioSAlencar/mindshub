<?php

namespace Database\Seeders;

use App\Models\Medal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtém os requisitos de XP para os níveis do User model
        $levelXpRequirements = User::getLevelXpRequirementsMapping();

        Medal::updateOrCreate(
            ['name' => 'Início'],
            [
                'description' => 'Você começou sua jornada com sucesso!',
                'icon' => 'assets/medals/Medal_Level_1.svg',
                'xp_required' => $levelXpRequirements[1] ?? 0,
                'condition_type' => 'level',
                'condition_value' => 1,
            ]
        );

        Medal::updateOrCreate(
            ['name' => 'Aventureiro Nível 10'],
            [
                'description' => 'Parabéns por alcançar o Nível 10!',
                'icon' => 'assets/medals/Medal_Level_10.svg',
                'xp_required' => $levelXpRequirements[10] ?? 102,
                'condition_type' => 'level',
                'condition_value' => 10,
            ]
        );

        Medal::updateOrCreate(
            ['name' => 'Explorador Nível 25'],
            [
                'description' => 'Você desbravou caminhos e alcançou o Nível 25!',
                'icon' => 'assets/medals/Medal_Level_25.svg',
                'xp_required' => $levelXpRequirements[25] ?? 637,
                'condition_type' => 'level',
                'condition_value' => 25,
            ]
        );

        Medal::updateOrCreate(
            ['name' => 'Mestre Nível 50'],
            [
                'description' => 'Sua dedicação o levou ao Nível 50. Impressionante!',
                'icon' => 'assets/medals/Medal_Level_50.svg',
                'xp_required' => $levelXpRequirements[50] ?? 2500,
                'condition_type' => 'level',
                'condition_value' => 50,
            ]
        );

        Medal::updateOrCreate(
            ['name' => 'Lenda Nível 100'],
            [
                'description' => 'Você é uma Lenda! Nível 100 alcançado!',
                'icon' => 'assets/medals/Medal_Level_100.svg',
                'xp_required' => $levelXpRequirements[100] ?? 10000,
                'condition_type' => 'level',
                'condition_value' => 100,
            ]
        );
    }
}
