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

    public function __construct(private UserDto $user, private int $id)
    {
    }

    public function handle(): bool
    {
        $updater = new UserPasswordUpdater;

        return $updater($this->user, $this->id);
    }
}
