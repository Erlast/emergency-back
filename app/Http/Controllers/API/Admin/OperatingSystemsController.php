<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController;
use App\Models\OperatingSystem;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OperatingSystemsController extends BaseController
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->apiResponse(function () {
            return OperatingSystem::query()->get();
        });
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {
            $name = $request->get('name');

            $operatingSystem = new OperatingSystem();
            
            $operatingSystem->name = $name;

            $operatingSystem->save();

            return $operatingSystem;
        });
    }
}
