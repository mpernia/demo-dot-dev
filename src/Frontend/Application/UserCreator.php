<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Domain\UserType;
use App\Src\Frontend\Infrastructure\Models\Student;
use App\Src\Frontend\Infrastructure\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserCreator
{
    public function __invoke(UserDto $user) : Authenticatable
    {
        try {
            $table = $user->getType() === UserType::TEACHER ? 'teachers' : 'students';
            $id = DB::table($table)->insertGetId([
                'name'     => $user->getName(),
                'password' => $user->passwd(),
                'email'    => $user->getEmail()
            ]);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return $table === 'teachers'
            ? Teacher::findOrFail($id)
            : Student::findOrFail($id);
    }
}

