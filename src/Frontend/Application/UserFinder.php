<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserType;
use App\Src\Frontend\Infrastructure\Models\Student;
use App\Src\Frontend\Infrastructure\Models\Teacher;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserFinder
{
    public function __invoke(int $id, string $type = UserType::TEACHER) : Authenticatable
    {
        $table = $type === UserType::TEACHER ? 'teachers' : 'students';
        return $table === 'teachers'
            ? Teacher::findOrFail($id)
            : Student::findOrFail($id);
    }
}