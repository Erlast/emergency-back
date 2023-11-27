<?php

namespace App\Exceptions;

class BadParamException extends \DomainException
{
    protected $code = 400;
    protected $message = 'Указанные параметры не соответствуют формату';
}
