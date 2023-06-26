<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserType;
use Illuminate\Support\Facades\DB;

class UserDestroyer
{
    public function __invoke(int $id, string $type = UserType::TEACHER) : void
    {
        $table = $type === UserType::TEACHER ? 'teachers' : 'students';
        DB::statement(
            sprintf("DELETE * FROM %s WHERE id = %d;", $table, $id)
        );
    }
}