<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CommonException;
use App\Models\News;
use App\Models\Section;
use App\Traits\TransformTree;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends BaseController
{
    use TransformTree;

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->apiResponse(function () {
            return News::orderBy('created_at', 'desc')->limit(10)->get();
        });
    }

    /**
     * @return JsonResponse
     */
    public function sections(): JsonResponse
    {
        return $this->apiResponse(function () {
            return Section::whereNull('p_id')->get();
        });
    }

    /**
     * @param Request $request
     * @param $slug
     * @return JsonResponse
     */
    public function section(Request $request, $slug): JsonResponse
    {
        return $this->apiResponse(function () use ($request, $slug) {
            /** @var Section $section */
            $section = Section::with(['children', 'documents'])->where(['slug' => $slug])->first();

            if ($section->is_share) {
                $path = $request->get('path');
                $children = $this->readDirectory($section, $path);
                return [
                    'id' => $section->id,
                    '_id' => 'sec_' . $section->id,
                    'name' => $section->name,
                    'is_dir' => true,
                    'slug' => $section->slug,
                    'is_share' => $section->is_share,
                    'parent_id' => $section->p_id,
                    'children' => $children
                ];
            }
            return $this->transform($section);

        });
    }

    public function downloadFile(Request $request)
    {
        $fileUrl = $request->get('fileUrl');

        if (!$fileUrl)
            throw new CommonException('Не передано имя файла');

        $header = [
            'Content-Type' => 'application/*',
        ];
        return Storage::download($fileUrl, 'name', $header);
    }

}
