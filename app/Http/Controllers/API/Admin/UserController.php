<?php

namespace App\Http\Controllers\API\Admin;

use App\Exceptions\ValidationFailsException;
use App\Helpers\CurrentUser;
use App\Http\Controllers\API\BaseController;
use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    private UserValidator $validatorClass;

    public function __construct(UserValidator $validator)
    {
        $this->validatorClass = $validator;
    }

    /**
     * @return JsonResponse
     */
    public function oneCurrent(): JsonResponse
    {
        return $this->apiResponse(function () {
            return CurrentUser::get();
        });
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->apiResponse(function () {
            $query = User::query();
            $users = $query->orderBy('created_at', 'desc')->limit(5)->get();
            $total = $query->count();
            return compact('users', 'total');

        });
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {
            $validator = $this->validatorClass->getNotEmptyValidator($request);

            if ($validator->fails())
                throw new ValidationFailsException();

            $id = $request->get('id');
            $name = $request->get('name');
            $email = $request->get('email');
            $password = $request->get('password');
            $role = $request->get('role');

            $user = new User();

            if ($id) {
                $user = User::find($id);
            }

            $user->name = $name;
            $user->email = $email;
            $user->role = $role;
            if ($password)
                $user->password = bcrypt($password);

            $user->save();

            return $user;

        });
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function one($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            return User::find($id);
        });
    }

    public function delete($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            User::find($id)->delete();
            return true;
        });
    }
}
