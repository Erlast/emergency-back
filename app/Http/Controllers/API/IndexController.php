<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Http\JsonResponse;

class IndexController extends BaseController
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->apiResponse(function () {
            return News::orderBy('created_at', 'desc')->limit(10)->get();
        });
    }
}
