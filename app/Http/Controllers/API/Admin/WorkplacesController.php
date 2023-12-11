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
    public function index(): JsonResponse
    {
        return $this->apiResponse(function () {
            $workplaces = Workplace::query()->with(['department', 'ip', 'person','operatingSystem'])->get();
            $total = $workplaces->count();
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
