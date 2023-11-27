<?php

namespace App\Exceptions;

class AccessTokenWrongException extends \DomainException
{

    protected $message = 'Неверный токен';
    protected $code = 403;
}
