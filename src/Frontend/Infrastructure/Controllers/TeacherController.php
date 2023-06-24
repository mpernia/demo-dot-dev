<?php

namespace App\Src\Frontend\Infrastructure\Controllers;

use App\Src\Frontend\Domain\UserType;
use App\Src\Shared\Infrastructure\Jobs\ChangePasswordJob;
use App\Src\Shared\Infrastructure\Requests\UpdateRequest;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        //
    }

    public function edit(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }

    public function changePassword(Dispatcher $dispatcher, UpdateRequest $request, int $id)
    {
        $changePasswordJob = $dispatcher->dispatchNow(
            new ChangePasswordJob($request->all(), $id, UserType::TEACHER)
        );
    }
}
