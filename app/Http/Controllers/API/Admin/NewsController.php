<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\BaseController;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends BaseController
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->apiResponse(function () {
            $query = News::query();
            $news = $query->orderBy('created_at', 'desc')->limit(5)->get();
            $total = $query->count();
            return compact('news', 'total');

        });
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function one($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            return News::find($id);
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
            $title = $request->get('title');
            $content = $request->get('content');

            $news = new News();

            if ($id)
                $news = News::find($id);

            $news->title = $title;
            $news->content = $content;
            $news->save();
            return true;
        });


    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        return $this->apiResponse(function () use ($id) {
            News::find($id)->delete();
            return true;
        });
    }
}
