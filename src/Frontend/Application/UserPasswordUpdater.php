<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Domain\UserType;
use Exception;
use Illuminate\Support\Facades\DB;

class UserPasswordUpdater
{
    public function __invoke(UserDto $user, int $id) : bool
    {
        try {
            $table = $user->getType() === UserType::TEACHER ? 'teachers' : 'students';
            DB::statement(
                sprintf("UPDATE %s SET password = '%s' WHERE id = %d", $table, $user->passwd(), $id)
            );
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
