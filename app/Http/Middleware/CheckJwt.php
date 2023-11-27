<?php

namespace App\Http\Middleware;

use App\Exceptions\AccessTokenHasExpiredException;
use App\Exceptions\AccessTokenWrongException;
use App\Helpers\CurrentUser;
use App\Services\JwtTokenService;
use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;


class CheckJwt
{
    private array $exceptRouteNames = [];
    private JwtTokenService $jwtTokenService;

    public function __construct(JwtTokenService $jwtTokenService)
    {
        $this->jwtTokenService = $jwtTokenService;
    }

    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->bearerToken();
//dd($request->header('Authorization'));
            if (!$token) {
                $this->throwOnNonExceptionalRoute($request);
                return $next($request);
            }
//dd($token);
            $this->jwtTokenService->validate($token);

            $userId = $this->jwtTokenService->getUserId();

            if (!$userId)
                throw new AccessTokenWrongException();

            /* @var UserService $userService */
            $userService = resolve(UserService::class);
                $user = $userService->getById($userId);

                if (!$user)
                    throw new AccessTokenWrongException();

                CurrentUser::set($user);

            return $next($request);
        } catch (\Exception $e) {
            switch (true) {
                case $e instanceof AccessTokenWrongException:
                case $e instanceof AccessTokenHasExpiredException:
                    return response()->json([
                        'error' => $e->getMessage(),
                    ], $e->getCode());
                default:
                    return response()->json([
                        'error' => $e->getMessage(),
                    ], 500);
            }
        }

    }

    public function throwOnNonExceptionalRoute($request)
    {
        if (!in_array($request->route()->getName(), $this->exceptRouteNames)) {
            throw new AccessTokenWrongException();
        }
    }
}
