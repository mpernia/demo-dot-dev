<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserType;
use Illuminate\Support\Facades\DB;

class UserIdFinder
{
    public function __invoke(string $email, string $type = UserType::TEACHER) : int|null
    {
        $table = $type === UserType::TEACHER ? 'teachers' : 'students';
        $result = DB::select(sprintf("SELECT id FROM %s WHERE email = '%s'", $table, $email));
        return !empty($result) ? (int)$result[0]->id : null;
    }
}