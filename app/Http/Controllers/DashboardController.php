<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\RecentDisciplineView;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $userId = auth()->id();
        $search = $request->input('search');

        $recentDisciplines = RecentDisciplineView::with('discipline')
        ->where('user_id', $userId)
        ->whereHas('discipline', function ($query) use ($userId) {
            $query->where('creator_id', '!=', $userId);
        })
        ->orderByDesc('viewed_at')
        ->limit(5)
        ->get();

        if ($search) {
            $disciplines = Discipline::where('title', 'like', '%' . $search . '%')->get();
        } else {
            $disciplines = Discipline::all();
        }

        return view('dashboard', compact('recentDisciplines', 'disciplines', 'search'));
    }


    public function registerDisciplineView($disciplineId)
    {
        $userId = auth()->id();

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
