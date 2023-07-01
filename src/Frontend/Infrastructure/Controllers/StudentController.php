<?php

namespace App\Src\Frontend\Infrastructure\Controllers;

use App\Src\Frontend\Application\UserCreator;
use App\Src\Frontend\Application\UserDestroyer;
use App\Src\Frontend\Application\UserFinder;
use App\Src\Frontend\Application\UserUpdater;
use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Domain\UserType;
use App\Src\Frontend\Infrastructure\Requests\UpdateRequest;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudentController extends Controller
{
    public function store(Request $request, UserCreator $creator): View|Application|Factory|ApplicationAlias
    {
        $user = $creator->__invoke(
            new UserDto(
                password: $request->get('password'),
                email: $request->get('email'),
                type: UserType::STUDENT,
                name: $request->get('name')
            )
        );
        return view('frontend.student.index', compact('user'));
    }

    public function show(UserFinder $finder, int $id): View|Application|Factory|ApplicationAlias
    {
        $student = $finder->__invoke($id, UserType::STUDENT);
        return view('frontend.student.index', compact('student'));
    }

    public function edit(UserFinder $finder, int $id): View|Application|Factory|ApplicationAlias
    {
        $student = $finder->__invoke($id, UserType::STUDENT);
        return view('frontend.student.edit', compact('student'));
    }

    public function update(UpdateRequest $request, int $id, UserUpdater $updater, UserFinder $finder): View|Application|Factory|ApplicationAlias
    {
        $updater->__invoke(
            new UserDto(
                password: $request->get('password'),
                email: $request->get('email'),
                type: UserType::STUDENT,
                name: $request->get('name')
            ),
            $id
        );
        $student = $finder->__invoke($id, UserType::STUDENT);
        return view('frontend.student.index', compact('student'));
    }

    public function destroy(UserDestroyer $destroyer, int $id): View|Application|Factory|ApplicationAlias
    {
        $destroyer->__invoke($id, UserType::STUDENT);
        return view('frontend.home.index');
    }
}
