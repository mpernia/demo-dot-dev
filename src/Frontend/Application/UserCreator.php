<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Domain\UserType;
use Exception;
use Illuminate\Support\Facades\DB;

class UserCreator
{
    public function __invoke(UserDto $user) : bool
    {
        try {
            $table = $user->getType() === UserType::TEACHER ? 'teacher' : 'student';
            DB::statement(
                sprintf("INSERT INTO s% () VALUES (''%s', '%s', '%s'')", $table, $user->getUsername(), $user->getPassword(), $user->getEmail())
            );
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}

