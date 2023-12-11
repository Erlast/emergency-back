<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController;
use App\Models\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends BaseController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        return $this->apiResponse(function () use ($request) {
            $id = $request->get('id');

            $document = new Document();

            if ($id) {
                $document = Document::find($id);
            }

            DB::transaction(function () use ($request, $document) {
                $document->name = $request->get('name');

                $document->section_id = $request->get('p_id');

                $document->save();

                $path = [];
                $this->buildPath($document->parent, $path);

                rsort($path);

                $file = $request->file('file');

                if ($file) {
                    $url = Storage::putFile(implode('/', $path), $file);
                } else {
                    $url = $request->get('file');
                }

                $document->url = $url;
                $document->save();
            });


            return $document;
        });
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            $document = Document::find($id);

            if (Storage::has($document->url))
                Storage::delete($document->url);

            $document->delete();
            return true;
        });
    }

    private function buildPath($parent, &$path)
    {
        if (!$parent) {
            return;
        }

        $path[] = $parent->slug;

        $this->buildPath($parent->parent, $path);

    }
}
