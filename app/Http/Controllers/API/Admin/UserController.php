<?php

namespace App\Http\Controllers\API\Admin;

use App\Helpers\CurrentUser;
use App\Http\Controllers\API\BaseController;

class UserController extends BaseController
{

    public function one()
    {
        return CurrentUser::get();
    }
}
