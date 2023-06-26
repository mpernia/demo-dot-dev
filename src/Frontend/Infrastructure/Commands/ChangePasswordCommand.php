<?php

namespace App\Src\Frontend\Infrastructure\Commands;

use App\Src\Frontend\Application\UserPasswordUpdater;
use Exception;
use Illuminate\Console\Command;

class ChangePasswordCommand extends Command
{
    protected $signature = 'passwd 
                            {id : The identifier of the user to change the password} 
                            {password : The new password} 
                            {--type= : The type of user, possible values are: teacher and student}';
    protected $description = 'Change the user password';

    public function handle()
    {
        $id = $this->argument('id');
        $password = $this->argument('password');
        $type = $this->option('type');

        try {
            $updater = new UserPasswordUpdater;
            $updater($id, $password, $type);
        } catch (Exception $exception) {
            $this->error("The change password was fail: \"{$exception->getMessage()}\".");
            return Command::FAILURE;
        }
        $this->info("The password was changed successfully.");
        return Command::SUCCESS;
    }
}
