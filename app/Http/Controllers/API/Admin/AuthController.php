<?php

namespace App\Http\Controllers\API\Admin;

use App\Exceptions\BadParamException;
use App\Http\Controllers\API\BaseController;
use App\Models\User;
use App\Models\UserRefreshToken;
use App\Services\JwtTokenService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {

            $validator = Validator::make($request->all(), [
                'login' => 'required|string|max:255',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(', ', $validator->errors()->all()), 401);
            }

            $userService = new UserService();
            $data = [
                'login' => $request->login,
                'password' => $request->password
            ];

            $user = $userService->getByLoginAndPassword($data);

            if(!$user)
                throw new \Exception('Unauthorized');

            return $this->createJWT($user);

        }, false);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {

            $token = $request->get('access_token');

            /* @var JwtTokenService $tokenService */
            $tokenService = resolve(JwtTokenService::class);
            $tokenData = $tokenService->parseToken($token);

            $user = User::find($tokenData['user_id']);

            if (!$user)
                throw new BadParamException();

            $token = $tokenService->refresh($user);

            // Получаем данные о Refresh token
            /* @var UserRefreshToken $refreshToken */
            $refreshToken = $tokenService->getRefreshTokenById(
                $token->claims()->get($tokenService::REFRESH_ID_KEY)
            );

            $token_expires_in = Carbon::createFromTimestamp($token->claims()->get('exp')->getTimestamp())
                ->format('Y-m-d H:i:s');

            return [
                'token_type' => 'jwt',
                'access_token' => $token->toString(),
                'expires_in' => $token_expires_in,
                'refresh_token' => $refreshToken->token,
                'refresh_token_expires_in' => $refreshToken->expires_at,
            ];
        }, false);

    }

    private function createJWT($result): array
    {
        // Создаем токен JWT
        /* @var JwtTokenService $tokenService */
        $tokenService = resolve(JwtTokenService::class);
        $token = $tokenService->create($result);

        // Получаем данные о Refresh token
        /* @var UserRefreshToken $refreshToken */
        $refreshToken = $tokenService->getRefreshTokenById(
            $token->claims()->get($tokenService::REFRESH_ID_KEY)
        );

        $token_expires_in = Carbon::createFromTimestamp($token->claims()->get('exp')->getTimestamp())
            ->format('Y-m-d H:i:s');

        return [
            'token_type' => 'jwt',
            'access_token' => $token->toString(),
            'expires_in' => $token_expires_in,
            'refresh_token' => $refreshToken->token,
            'refresh_token_expires_in' => $refreshToken->expires_at,
        ];
    }
}
