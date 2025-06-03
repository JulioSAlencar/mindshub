<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteInactiveUsers extends Command
{
    protected $signature = 'accounts:delete-pending';
    protected $description = 'Deleta contas marcadas para exclusão após 90 dias';

    public function handle()
    {
        $users = User::where('is_pending_deletion', true)
            ->where('deletion_requested_at', '<=', Carbon::now()->subDays(90))
            ->get();

        foreach ($users as $user) {
            $this->info("Deletando usuário: {$user->email}");
            $user->delete();
        }

        return 0;
    }
}
