<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserValidator
{

    public function getNotEmptyValidator(Request $request): \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable|integer',
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string',
            'role' => 'required|integer|in:1,2',
        ];

        return Validator::make($request->all(), $rules, [], []);
    }
}
