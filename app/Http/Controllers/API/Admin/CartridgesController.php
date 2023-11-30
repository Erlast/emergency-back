<?php

namespace App\Http\Controllers\API\Admin;

use App\Events\SaveCartridgeHistory;
use App\Exceptions\ValidationFailsException;
use App\Http\Controllers\API\BaseController;
use App\Models\Cartridge;
use App\Validators\CartridgeValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartridgesController extends BaseController
{
    private CartridgeValidator $validatorClass;

    public function __construct(CartridgeValidator $validator)
    {
        $this->validatorClass = $validator;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {

            $paginator = $this->preparePaginate($request);

            $query = Cartridge::query();
            $cartridges = $query
                ->with(['brand', 'printerModel', 'department'])
                ->orderBy($paginator['sort'], $paginator['direction']);

            $total = $cartridges->count();

            if ($paginator['page'] !== null && $paginator['perPage'])
                $cartridges = $cartridges->skip(($paginator['page'] - 1) * $paginator['perPage'])->take($paginator['perPage']);

            $cartridges = $cartridges->get();
            $page = $paginator['page'];

            return compact('cartridges', 'total', 'page');

        });
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function one($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            return Cartridge::with(['brand', 'printerModel', 'department'])->where(['id' => $id])->first();
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
            $brand_id = $request->get('brand_id');
            $model_id = $request->get('model_id');
            $department_id = $request->get('department_id');
            $sh_code = $request->get('sh_code');
            $status = $request->get('status');

            $statusFrom = null;

            $cartridge = new Cartridge();

            if ($id) {
                $cartridge = Cartridge::find($id);
                $statusFrom = $cartridge->status;
            }

            $cartridge->brand_id = $brand_id;
            $cartridge->model_id = $model_id;
            $cartridge->sh_code = $sh_code;
            $cartridge->status = $status;
            $cartridge->department_id = $department_id;

            $cartridge->save();

            if ($statusFrom != $cartridge->status)
                event(new SaveCartridgeHistory($cartridge, $statusFrom));

            return $cartridge;

        });
    }

    public function preparePaginate($request): array
    {
        $perPage = $request->get('perPage', 10);
        $page = $request->get('page', 1);
        $sort = $request->get('sort', 'id');
        $direction = 'ASC';

        if (str_starts_with($sort, '-')) {
            $sort = substr($sort, 1);
            $direction = 'DESC';
        }

        return compact('page', 'perPage', 'sort', 'direction');
    }

}
