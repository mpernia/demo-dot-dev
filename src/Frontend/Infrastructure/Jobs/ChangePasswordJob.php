<?php

namespace App\Src\Frontend\Infrastructure\Jobs;

use App\Src\Frontend\Application\UserPasswordUpdater;
use App\Src\Frontend\Domain\UserDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangePasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(UserDto $user, int $id): void
    {
        $updater = new UserPasswordUpdater;

        $updater($id, $user->getPassword(), $user->getType());
    }
}
