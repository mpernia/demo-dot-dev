<?php

namespace App\Src\Frontend\Application;

use App\Src\Frontend\Application\UserCreator;
use App\Src\Frontend\Domain\UserDto;
use App\Src\Frontend\Domain\UserType;
use App\Src\Frontend\Infrastructure\Requests\LoginRequestRequest;
use App\Src\Frontend\Infrastructure\Requests\SigninRequestRequest;
use App\Src\Shared\Infrastructure\Traits\FingerPrint;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticator
{
    use FingerPrint;

    public static function login(LoginRequestRequest $request, string $guard = UserType::TEACHER) : bool
    {
        try {
            $credentials = self::credentials($request);
            $isLogged = Auth::guard($guard)->attempt(
                credentials: $credentials,
                remember: $request->boolean('remember')
            );
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
                $request->session()->put('guard', $guard);
                $request->session()->put(
                    key: 'fingerprint',
                    value: self::stamp([
                        $credentials['email'],
                        $guard,
                        md5(sprintf('%s a %s b %s', self::$seed, $guard, $credentials['email']))
                    ])
                );
            }
        } catch (Exception $e) {
            throw new AuthenticationException(
                message: 'Unauthenticated.',
                guards: [$guard],
                redirectTo: config('app.url'));
        }
        return $isLogged;
    }

    public static function logout(Request $request, string $guard = UserType::TEACHER) : void
    {
        try {
            Auth::guard($guard)->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } catch (Exception $exception) {
            throw new Exception('Logout was fail: ' . $exception->getMessage());
        }
    }

    public static function register(SigninRequestRequest $request, string $guard = UserType::TEACHER) : void
    {
        $creator = new UserCreator;
        try {
            $user = $creator(self::newUser($request));
            event(new Registered($user));
            Auth::guard($guard)->login($user);
        } catch (Exception $exception) {
            throw new Exception('Register user was fail: ' . $exception->getMessage());
        }
    }

    protected static function newUser(SigninRequestRequest $request) : UserDto
    {
        return new UserDto(
            password: $request->get('password'),
            email: $request->get('email'),
            type: $request->get('select_type'),
            name: $request->get('name')
        );
    }

    protected static function credentials(LoginRequestRequest $request) : array
    {
        return [
            'email'    => $request->get('email'),
            'password' => $request->get('password')
        ];
    }
}