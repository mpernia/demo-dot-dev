<?php

namespace App\Src\Shared\Infrastructure\Jobs;

use App\Src\Frontend\Application\PasswordUpdater;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangePasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(array $data, int $id, string $type): void
    {
        $updater = new PasswordUpdater;

        $updater($id, $data['password'], $data['email'], $type);
    }
}
