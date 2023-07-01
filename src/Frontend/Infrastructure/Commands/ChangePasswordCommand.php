<?php

namespace App\Src\Frontend\Infrastructure\Commands;

use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Application\UserPasswordUpdater;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ChangePasswordCommand extends Command
{
    protected $signature = 'passwd 
                            {id : The identifier of the user to change the password} 
                            {password : The new password} 
                            {--type= : The type of user, possible values are: teacher and student}';
    protected $description = 'Change the user password';

    public function handle() : int
    {
        $id = $this->argument('id');
        $user = new UserDto(
            password: $this->argument('password'),
            email: 'user@example.com',
            type: $this->argument('type')
        );
        try {
            $updater = new UserPasswordUpdater;
            $updater($user, $id);
        } catch (Exception $exception) {
            $this->error("The change password was fail: \"{$exception->getMessage()}\".");
            return CommandAlias::FAILURE;
        }
        $this->info("The password was changed successfully.");
        return CommandAlias::SUCCESS;
    }
}
