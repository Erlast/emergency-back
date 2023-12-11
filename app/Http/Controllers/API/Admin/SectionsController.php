<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController;
use App\Models\Document;
use App\Models\Section;
use App\Traits\TransformTree;
use App\Traits\UniqueModelSlug;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionsController extends BaseController
{

    use UniqueModelSlug, TransformTree;

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return $this->apiResponse(function () {
            $sections = Section::query()->with(['children', 'documents'])->whereNull('p_id')->get();
            $result = [];
            foreach ($sections as $section) {
                $result[] = $this->transform($section);
            }
            return $result;

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

            $section = new Section();

            if ($id) {
                $section = Section::find($id);
            }

            if ($request->get('generate_slug') && $request->get('name') != $section->name) {
                $section->slug = $this->generateSlug(Section::class, $request->get('name'));
            } else {
                $section->slug = $request->get('slug');
            }

            $section->name = $request->get('name');
            $section->p_id = $request->get('p_id');
            $section->is_share = (int)$request->get('is_share', 0);

            $section->save();

            return $section;
        });
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            $document = Section::find($id);
            $document->delete();
            return true;
        });
    }


}
