<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{

    /**
     * Общая схема ответа для любого API относящегося к OpenTrainer функционалу
     *
     * @param callable $fn
     * @param bool $wrapResponse
     * @return JsonResponse
     */
    protected function apiResponse(callable $fn, bool $wrapResponse = true): JsonResponse
    {
        try {
            $data = call_user_func($fn);

            if ($wrapResponse) {
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }

            return response()->json($data);

        } catch (\Throwable $e) {

            switch (true) {
//                case $e instanceof LoginAlreadyRegisteredException:
//                    return response()->json([
//                        'error' => [
//                            'message' => $e->getMessage(),
//                            'code' => 'ValidationError',
//                            'field' => 'login'
//                        ]
//                    ], 400);
                default:
                    return response()->json([
                        'error' => [
                            'message' => $e->getMessage(),
                        ]
                    ], 500);


            }

        }
    }
}
