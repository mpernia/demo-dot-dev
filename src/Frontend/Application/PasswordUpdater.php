<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserType;
use Illuminate\Support\Facades\DB;

class PasswordUpdater
{
    public function __invoke(string $id, string $password, $type = UserType::TEACHER)
    {
        try {
            $table = $type === UserType::TEACHER ? 'teacher' : 'student';
            DB::statement(
                sprintf("UPDATE s% SET password = '%s' WHERE id = %d", $table, $password, $id)
            );
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
