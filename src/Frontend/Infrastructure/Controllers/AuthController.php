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
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequestRequest $request, UserIdFinder $userIdFinder)
    {
        $type = $request->get('login_type');
        $id = $userIdFinder->__invoke(email: $request->get('login_email'), type: $type);
        if (is_null($id)) {
            return redirect()->route('landing-page');
        }
        return UserAuthenticator::login($request, $type)
            ? redirect()->route('frontend.' . $type . '.show', ['id' => $id])
            : redirect()->route('landing-page');
    }

    public function logout(Request $request)
    {
        UserAuthenticator::logout($request);
        return redirect()->route('landing-page');
    }

    public function signin(SigninRequestRequest $request, UserCreator $creator)
    {
        $type = $request->get('signin_type');
        try {
            $user = $creator(
                new UserDto(
                    password: $request->get('signin_password'),
                    email: $request->get('signin_email'),
                    name: $request->get('signin_name'),
                    type: $request->get('signin_type')
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
