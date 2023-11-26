<?php

namespace App\Validators;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PcValidator
{

    public function getPcNotEmptyValidator(Request $request): \Illuminate\Validation\Validator
    {
        $rules = [
            'inpnum' => 'sometimes|required_without:inpip',
            'inpip' => 'sometimes|required_without:inpnum',
            'krp' => 'sometimes|required',
        ];

        return Validator::make($request->all(), $rules, [], []);
    }
}
