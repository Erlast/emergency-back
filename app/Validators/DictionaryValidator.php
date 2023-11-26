<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DictionaryValidator
{
    public function getNameNotEmptyValidator(Request $request): \Illuminate\Validation\Validator
    {
        $rules = [
            'name' => 'required',
        ];

        return Validator::make($request->all(), $rules, [], []);
    }
}
