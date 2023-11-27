<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getByLoginAndPassword($data)
    {

        $user = User::where(['name' => $data['login']])->first();

        if (!$user)
            return null;

        if (!Hash::check($data['password'], $user->password))
            return null;

        return $user;
    }

    public function getById(int $id)
    {
        return User::find($id);
    }
}
