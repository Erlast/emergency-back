<?php

namespace App\Exceptions;

class NoRecognizeDictionaryException extends \Exception
{

    protected $code=404;
    protected $message='Не удалось распознать справочник';
}
