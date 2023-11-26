<?php

namespace App\Http\Controllers\API\Admin;

use App\Exceptions\NoRecognizeDictionaryException;
use App\Http\Controllers\API\BaseController;
use App\Models\Brand;
use App\Models\Department;
use App\Models\MisDoc;
use App\Models\PrinterModel;
use App\Validators\DictionaryValidator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DictionariesController extends BaseController
{
    private $validatorClass;

    public function __construct(DictionaryValidator $validator)
    {
        $this->validatorClass = $validator;
    }

    /**
     * @param $dictionary
     * @return JsonResponse
     */
    public function index($dictionary): JsonResponse
    {
        return $this->apiResponse(function () use ($dictionary) {

            switch ($dictionary) {
                case 'brand':
                    return Brand::all();
                case 'printerModel':
                    return PrinterModel::all();
                case 'department':
                    return Department::all();
                default:
                    throw new NoRecognizeDictionaryException();
            }
        });
    }

    /**
     * @param Request $request
     * @param $dictionary
     * @return JsonResponse
     */
    public function save(Request $request, $dictionary): JsonResponse
    {
        return $this->apiResponse(function () use ($request, $dictionary) {

            $validator = $this->validatorClass->getNameNotEmptyValidator($request);

            if ($validator->fails())
                throw new Exception('Нет наименования.', 422);

            $name = $request->get('name');

            if (!$dictionary)
                throw new NoRecognizeDictionaryException();

            $modelName = 'App\\Models\\' . ucfirst($dictionary);
            try {
                $model = new $modelName();
                $model->name = $name;
                $model->save();
            } catch (Exception $e) {
                throw new NoRecognizeDictionaryException();
            }

            return true;

        });
    }
}
