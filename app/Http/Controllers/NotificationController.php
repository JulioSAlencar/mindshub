<?php

namespace App\Http\Controllers;

use App\Models\Medal;
use App\Models\User;
use App\Notifications\MedalAwardedNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MedalEarnedNotification;


class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $notification = $user->unreadNotifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back();
    }

    function verificarMedalhas(User $user)
    {
        $medalhas = Medal::where('condition_type', 'level')
            ->where('condition_value', '<=', $user->level)
            ->get();

        foreach ($medalhas as $medalha) {
            if (!$user->medals->contains($medalha->id)) {
                $user->medals()->attach($medalha->id);

                // Envia notificação
                $user->notify(new MedalAwardedNotification($medalha));
            }
        }
    }

    public function markAllAsRead()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'Todas as notificações foram marcadas como lidas.');
    }


}
