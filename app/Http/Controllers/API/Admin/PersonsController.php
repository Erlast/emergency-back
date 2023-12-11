<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController;

use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PersonsController extends BaseController
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->apiResponse(function () {
            return Person::query()->get();
        });
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {
            $surname = $request->get('surname');
            $name = $request->get('name');
            $middleName = $request->get('middle_name');

            $person = new Person();

            $person->surname = $surname;
            $person->name = $name;
            $person->middle_name = $middleName;

            $person->save();

            return $person;
        });
    }
}
