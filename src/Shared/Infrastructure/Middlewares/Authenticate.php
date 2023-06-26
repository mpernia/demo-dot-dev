<?php

namespace App\Src\Shared\Infrastructure\Middlewares;

use App\Src\Frontend\Domain\UserType;
use App\Src\Shared\Infrastructure\Traits\FingerPrint;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class Authenticate
{
    use FingerPrint;

    protected Auth $auth;
    protected string $guard;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->guard = UserType::TEACHER;
    }

    public function handle($request, Closure $next)
    {
        if(!$request->session()->has('guard'))
        {
            $this->unauthenticated($request);
        }
        $this->guard = $request->session()->get('guard');
        $this->authenticate($request);
        return $next($request);
    }

    protected function authenticate($request): void
    {
        if (
            !$this->validateFingerprint($request->session()->get('fingerprint'))
            || !$this->auth->guard($this->guard)->check()
        ){
            $this->unauthenticated($request);
        }
        $this->auth->shouldUse($this->guard);
    }

    /**
     * @throws AuthenticationException
     */
    protected function unauthenticated($request)
    {
        throw new AuthenticationException(
            'Unauthenticated.', [$this->guard], $this->redirectTo($request)
        );
    }

    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('landing-page');
    }

    protected function validateFingerprint($fingerprint) : bool
    {
        $email = $this->auth->guard($this->guard)->user()->email;
        return $fingerprint === $this->stamp([
            $email,
            $this->guard,
            md5(sprintf('%s a %s b %s', self::$seed, $this->guard, $email))
        ]);
    }
}
