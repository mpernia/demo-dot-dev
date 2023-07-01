<?php

namespace App\Src\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Domain\UserType;
use App\Src\Frontend\Infrastructure\Jobs\ChangePasswordJob;
use App\Src\Frontend\Infrastructure\Requests\UpdateRequest;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\RedirectResponse;

class ChangePasswordController extends Controller
{
    public function __invoke(Dispatcher $dispatcher, UpdateRequest $request, string $type, int $id): RedirectResponse
    {
        $changePasswordJob = $dispatcher->dispatchNow(
            new ChangePasswordJob(
                new UserDto(
                    password: $request->get('password'),
                    email: $request->get('email'),
                    type: $type === 'teachers' ? UserType::TEACHER : UserType::STUDENT
                ),
                $id
            )
        );
        $type = $type === 'teachers' ? UserType::TEACHER : UserType::STUDENT;
        return $changePasswordJob === true
            ? redirect()->route('frontend.' . $type . '.show', ['id' => $id])
            : redirect()->route('frontend.' . $type . '.edit', ['id' => $id]);
    }
}
