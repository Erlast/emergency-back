<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController;
use App\Models\Workplace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkplacesController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {
            $workplaces = Workplace::query()->with(['department', 'ip', 'person', 'operatingSystem']);
            if ($filters = $request->get('filters')) {
                if (isset($filters['inventory_number'])) {
                    $workplaces->where('inventory_number', 'like', '%' . $filters['inventory_number'] . '%');
                }
                if (isset($filters['department_id'])) {
                    $workplaces->where(['department_id' => $filters['department_id']]);
                }

                if (isset($filters['ip'])) {
                    $ip = $filters['ip'];

                    $workplaces->whereHas('ip', function ($query) use ($ip) {
                        $query->where('ip_address', 'like', '%' . $ip . '%');
                    });
                }
            }
            $total = $workplaces->count();
            $workplaces = $workplaces->get();

            return compact('workplaces', 'total');
        });
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            $workplaces = Workplace::find($id);
            $workplaces->delete();
            return true;
        });
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function get($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            return Workplace::with(['person', 'ip', 'department', 'operatingSystem'])->where(['id' => $id])->first();
        });
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {
            $id = $request->get('id');

            $workplace = new Workplace();

            if ($id) {
                $workplace = Workplace::find($id);
            }

            $workplace->ip_id = $request->get('ip_id');
            $workplace->mac_address = $request->get('mac_address');
            $workplace->inventory_number = $request->get('inventory_number');
            $workplace->serial_number = $request->get('serial_number');
            $workplace->name = $request->get('name');
            $workplace->person_id = $request->get('person_id');
            $workplace->department_id = $request->get('department_id');
            $workplace->level = $request->get('level');
            $workplace->room = $request->get('room');
            $workplace->office = $request->get('office');
            $workplace->operating_system_id = $request->get('operating_system_id');
            $workplace->os_serial_number = $request->get('os_serial_number');
            $workplace->programming_office = $request->get('programming_office');
            $workplace->po_serial_number = $request->get('po_serial_number') ?? Workplace::SERIAL_FREE;

            $workplace->save();
            return $workplace;
        });
    }

}
