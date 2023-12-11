<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController;
use App\Models\Ip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IpsController extends BaseController
{

    /**
     * @return JsonResponse
     */
    public function free(): JsonResponse
    {
        return $this->apiResponse(function () {
            return Ip::query()->doesntHave('workplace')->get();
        });
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {
            $ip_address = $request->get('ip_address');
            $ipModel = new Ip();
            $ipModel->ip_address = $ip_address;
            $ipModel->save();
            return $ipModel;
        });
    }
}
