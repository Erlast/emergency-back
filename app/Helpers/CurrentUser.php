<?php

namespace App\Helpers;

use App\Models\User;

class CurrentUser
{
    const USER_KEY = 'user';

    /**
     * @return mixed|null
     */
    public static function get()
    {
        return config(self::USER_KEY) ?? null;
    }

    /**
     * @param User $user
     */
    public static function set(User $user)
    {
        config([self::USER_KEY => $user]);
    }

}
