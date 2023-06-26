<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Domain\UserType;
use Illuminate\Support\Facades\DB;

class UserUpdater
{
    public function __invoke(UserDto $user, int $id) : void
    {
        $table = $user->getType() === UserType::TEACHER ? 'teachers' : 'students';
        DB::statement(
            sprintf(
                "UPDATE %s SET email = '%s', password = '%s' %s WHERE id = %d;",
                $table,
                $user->getEmail(),
                $user->passwd(),
                is_null($user->getName() ? '' : ', name = ' . $user->getName()),
                $id
            )
        );
    }
}