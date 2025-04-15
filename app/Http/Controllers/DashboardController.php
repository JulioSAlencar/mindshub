<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\RecentDisciplineView;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $disciplines = Discipline::all(); // Corrigido aqui

        $recentDisciplines = RecentDisciplineView::with('discipline')
            ->where('user_id', auth()->id())
            ->orderByDesc('viewed_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact('recentDisciplines', 'disciplines'));
    }
}
