<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\RecentDisciplineView;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        
        $user = auth()->user();

        $recentDisciplines = RecentDisciplineView::with('discipline')
            ->where('user_id', $user->id)
            ->orderByDesc('viewed_at')
            ->limit(5)
            ->get();
            
        $disciplines = Discipline::all();
        
        return view('dashboard', compact('recentDisciplines', 'disciplines'));
    }
    public function registerDisciplineView($disciplineId)
    {
        $userId = Auth::id();

        RecentDisciplineView::updateOrCreate(
            ['user_id' => $userId, 'discipline_id' => $disciplineId],
            ['viewed_at' => Carbon::now()]
        );

        $views = RecentDisciplineView::where('user_id', $userId)
            ->orderBy('viewed_at', 'desc')
            ->skip(5)
            ->take(PHP_INT_MAX) 
            ->get();

        foreach ($views as $view) {
            $view->delete();
        }
    }

}
