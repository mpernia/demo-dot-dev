<?php

namespace App\Src\Shared\Infrastructure\Commands;

use Exception;
use Illuminate\Console\Command;

class ChangePasswordCommand extends Command
{
    protected $signature = 'passwd {userId} {password}';
    protected $description = 'Change the user password';

    public function handle()
    {
        $userId = $this->argument('userId');
        $password = $this->argument('password');

        try {
            //
        } catch (Exception $exception) {
            $this->error("The change password was fail: \"{$exception->getMessage()}\".");
            return Command::FAILURE;
        }
        $this->info("The password was changed successfully.");
        return Command::SUCCESS;
    }
}
