<?php

namespace App\Exceptions;

use Exception;

class ValidationFailsException extends Exception
{

    protected $code = 422;
    protected $message = "Ошибки валидации";
}
