<?php

namespace App\Src\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Frontend\Application\UserAuthenticator;
use App\Src\Frontend\Application\UserCreator;
use App\Src\Frontend\Application\UserIdFinder;
use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Infrastructure\Requests\LoginRequestRequest;
use App\Src\Frontend\Infrastructure\Requests\SigninRequestRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequestRequest $request, UserIdFinder $userIdFinder): RedirectResponse
    {
        $type = $request->get('select_type');
        $id = $userIdFinder->__invoke(email: $request->get('email'), type: $type);
        if (is_null($id)) {
            return redirect()->route('landing-page');
        }
        return UserAuthenticator::login($request, $type)
            ? redirect()->route('frontend.' . $type . '.show', ['id' => $id])
            : redirect()->route('landing-page');
    }

    public function logout(Request $request): RedirectResponse
    {
        UserAuthenticator::logout($request);
        return redirect()->route('landing-page');
    }

    public function signin(SigninRequestRequest $request, UserCreator $creator): RedirectResponse
    {
        $type = $request->get('select_type');
        try {
            $user = $creator(
                new UserDto(
                    password: $request->get('password'),
                    email: $request->get('email'),
                    type: $type,
                    name: $request->get('name')
                )
            );
        } catch (Exception $e) {
            return redirect()->route('landing-page');
        }
        return UserAuthenticator::login($request, $type)
            ? redirect()->route('frontend.' . $type . '.show', ['id' => $user->id])
            : redirect()->route('landing-page');
    }
}
