<?php

namespace App\Exceptions;

class InvalidRefreshTokenException extends \DomainException
{
    protected $code = 403;
    protected $message = 'Истек refresh_token';
}
