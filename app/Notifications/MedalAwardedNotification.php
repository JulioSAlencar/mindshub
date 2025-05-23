<?php

namespace App\Notifications;

use App\Models\Medal;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MedalAwardedNotification extends Notification
{
    use Queueable;

    protected Medal $medal;

    public function __construct(Medal $medal)
    {
        $this->medal = $medal;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }
    
    public function toDatabase($notifiable)
    {
        return [
            'medal_id' => $this->medal->id,
            'name' => $this->medal->name,
            'description' => $this->medal->description,
            'icon' => $this->medal->icon,
        ];
    }


}

