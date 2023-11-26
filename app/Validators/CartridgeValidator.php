<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartridgeValidator
{
    public function getNotEmptyValidator(Request $request): \Illuminate\Validation\Validator
    {
        $rules = [
            'id' => 'nullable|integer',
            'brand_id' => 'required|integer',
            'model_id' => 'required|integer',
            'department_id' => 'nullable|integer',
            'sh_code' => 'required|string',
            'status' => 'required|integer|in:1,2,3,4',
        ];

        return Validator::make($request->all(), $rules, [], []);
    }
}
