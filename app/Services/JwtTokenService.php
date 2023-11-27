<?php

namespace App\Services;

use App\Exceptions\AccessTokenHasExpiredException;
use App\Exceptions\AccessTokenWrongException;
use App\Exceptions\BadParamException;
use App\Exceptions\InvalidRefreshTokenException;
use App\Models\User;
use App\Models\UserRefreshToken;
use Carbon\Carbon;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\Plain;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Lcobucci\JWT\Validation\Validator;
use Ramsey\Uuid\Uuid;

class JwtTokenService
{

    const TOKEN_EXPIRE_AFTER = 1200;

    const REFRESH_ID_KEY = 'refresh_id';

    private string $issuer;
    private string $secretKey;
    private string $currentUserId;

    public function __construct(string $secretKey, string $issuer)
    {
        $this->secretKey = $secretKey;
        $this->issuer = $issuer;

    }

    public function getKey(): InMemory
    {
        return InMemory::base64Encoded($this->secretKey);
    }

    public function getUserId(): string
    {
        return $this->currentUserId;
    }


    public function getRefreshTokenById(int $id)
    {
        return UserRefreshToken::find($id);
    }

    /**
     * @param User $user
     * @param array $additional_params
     * @return Plain
     */
    public function create(User $user, array $additional_params = []): Plain
    {
        $refresh_token_has_expired = false;

        // Ищем старый UserRefreshToken
        $refreshToken = UserRefreshToken::query()
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Проверяем устарел ли он
        if ($refreshToken) {
            $refresh_token_expired_time = Carbon::createFromFormat('Y-m-d H:i:s', $refreshToken->expires_at);
            $refresh_token_has_expired = $refresh_token_expired_time < Carbon::now();
        }

        // Если его нет, создаем новый
        if (!$refreshToken || $refresh_token_has_expired) {
            $refreshToken = new UserRefreshToken();
            $refreshToken->user_id = $user->id;
            $refreshToken->save();
        }

        // алгоритм шифрования
        $signer = new Sha256();
        $time = new \DateTimeImmutable();
        $uid = Uuid::uuid4()->toString();

        // Базовые параметры JWT токена
        $builder = (new Builder(new JoseEncoder(), ChainedFormatter::default()))
            ->issuedBy($this->issuer)
            ->permittedFor($this->issuer)
            ->identifiedBy($uid)
            ->issuedAt($time)
            ->canOnlyBeUsedAfter($time)
            ->expiresAt($time->modify('+' . self::TOKEN_EXPIRE_AFTER . ' second'));

        // ID Refresh токена в бд
        $builder->withClaim(self::REFRESH_ID_KEY, $refreshToken->id);

        // информация о пользователе необходимая фронту React
        $builder->withClaim('user_id', $user->id ?? '');

        // Дополнительне параметры  которые можно передать в тело
        foreach ($additional_params as $key => $value) {
            $builder->withClaim($key, $value);
        }

        return $builder->getToken($signer, $this->getKey());
    }

    /**
     * @param string $token
     * @return array
     */
    public function parseToken(string $token): array
    {
        try {
            $token = (new Parser(new JoseEncoder()))->parse($token);
            $signer = new Sha256();

        } catch (\RuntimeException $e) {
            throw new AccessTokenWrongException();
        }

        $validator = new Validator();

        try {
            $validator->assert($token, new SignedWith($signer, $this->getKey()));
        } catch (RequiredConstraintsViolated $e) {
            throw new AccessTokenWrongException();
        }

        return [
            'refresh_token' => $token->claims()->get(self::REFRESH_ID_KEY),
            'user_id' => $token->claims()->get('user_id'),
        ];
    }

    /**
     * @param $token
     * @return bool
     */
    public function validate($token): bool
    {

        try {
            $token = (new Parser(new JoseEncoder()))->parse($token);
            $signer = new Sha256();
        } catch (\InvalidArgumentException|\RuntimeException  $e) {
            throw new AccessTokenWrongException();
        }

        $validator = new Validator();

        try {
            $validator->assert($token, new SignedWith($signer, $this->getKey()));
        } catch (RequiredConstraintsViolated $e) {
            throw new AccessTokenWrongException();
        }

        // проверяем устарел ли токен
        if ($token->isExpired(now())) {
            throw new AccessTokenHasExpiredException();

        }

        $this->currentUserId = $token->claims()->get('user_id');

        return true;

    }

    /**
     * @param User $user
     * @param array $additional_params
     * @return Plain
     */
    public function refresh(User $user, array $additional_params = []): Plain
    {
        // Ищем старый UserRefreshToken
        /* @var $refreshToken UserRefreshToken|null */
        $refreshToken = UserRefreshToken::query()
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Если его нет, кидаем исключение
        if (!$refreshToken) {
            throw new BadParamException();
        }

        // проверяем устарел ли refresh токен
        $refresh_token_expired_time = Carbon::createFromFormat('Y-m-d H:i:s', $refreshToken->expires_at);

        if ($refresh_token_expired_time < Carbon::now()) {
            throw new InvalidRefreshTokenException();
        }

        // алгоритм шифрования
        $signer = new Sha256();
        $time = new \DateTimeImmutable();

        // Базовые параметры JWT токена
        $builder = (new Builder(new JoseEncoder(), ChainedFormatter::default()))
            ->issuedBy($this->issuer)
            ->permittedFor($this->issuer)
            ->identifiedBy(Uuid::uuid4())
            ->issuedAt($time)
            ->canOnlyBeUsedAfter($time)
            ->expiresAt($time->modify('+' . self::TOKEN_EXPIRE_AFTER . ' sec'));

        // ID Refresh токена в бд
        $builder->withClaim(self::REFRESH_ID_KEY, $refreshToken->id);

        // информация о пользователе необходимая фронту React
        $builder->withClaim('user_id', $user->id ?? '');

        // Дополнительне параметры  которые можно передать в тело
        foreach ($additional_params as $key => $value) {
            $builder->withClaim($key, $value);
        }

        return $builder->getToken($signer, $this->getKey());
    }
}
