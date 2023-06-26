<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserType;
use Exception;
use Illuminate\Support\Facades\DB;

class UserPasswordUpdater
{
    public function __invoke(int $id, string $password, $type = UserType::TEACHER) : bool
    {
        try {
            $table = $type === UserType::TEACHER ? 'teacher' : 'student';
            DB::statement(
                sprintf("UPDATE %s SET password = '%s' WHERE id = %d", $table, bcrypt($password), $id)
            );
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
