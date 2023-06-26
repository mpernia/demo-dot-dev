<?php

namespace App\Src\Frontend\Infrastructure\Controllers;

use App\Src\Frontend\Application\UserCreator;
use App\Src\Frontend\Application\UserDestroyer;
use App\Src\Frontend\Application\UserFinder;
use App\Src\Frontend\Application\UserUpdater;
use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Infrastructure\Requests\UpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeacherController extends Controller
{
    public function store(Request $request, UserCreator $creator)
    {
        $user = $creator->__invoke(
            new UserDto(
                password: $request->get('password'),
                email: $request->get('email'),
                name: $request->get('name')
            )
        );
        return view('frontend.teacher.index', compact('user'));
    }

    public function show(UserFinder $finder, int $id)
    {
        $teacher = $finder->__invoke($id);
        return view('frontend.teacher.index', compact('teacher'));
    }

    public function edit(UserFinder $finder, int $id)
    {
        $teacher = $finder->__invoke($id);
        return view('frontend.teacher.edit', compact('teacher'));
    }

    public function update(UpdateRequest $request, int $id, UserUpdater $updater, UserFinder $finder)
    {
        $updater->__invoke(
            new UserDto(
                password: $request->get('password'),
                email: $request->get('email'),
                name: $request->get('name')
            ),
            $id
        );
        $teacher = $finder->__invoke($id);
        return view('frontend.teacher.index', compact('teacher'));
    }

    public function destroy(UserDestroyer $destroyer, int $id)
    {
        $destroyer->__invoke($id);
        return view('frontend.home.index');
    }
}
