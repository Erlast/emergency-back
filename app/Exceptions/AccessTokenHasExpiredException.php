<?php

namespace App\Exceptions;

class AccessTokenHasExpiredException extends \DomainException
{
    protected $code = 401;
    protected $message = 'Истек токен авторизации';
}
