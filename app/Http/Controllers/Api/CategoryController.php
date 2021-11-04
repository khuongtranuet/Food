<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepo;

    /**
     * CategoryController constructor.
     */
    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * URL: http://localhost:8000/api/v1/categories
     * http://localhost:8000/api/v1/categories?id=&keyword=&selection=
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listing(Request $request)
    {
        $params['keyword'] = request('keyword', null);
        $params['selection'] = request('selection', null);
        $params['page_index'] = request('page_index', 1);
        $params['page_size'] = request('page_size', 10);
        $params['id'] = request('id', null);
        //
        $params['order_by'] = [
            ['field' => 'id', 'direction' => 'DESC']
        ];
        //
        $data = Category::all();
        $total = $this->categoryRepo->listing($params, true);
        $data = $this->categoryRepo->listing($params, false);
        //
        return response()->json([
            'code' => 200,
            'message' => 'OK',
            'data' => $data,
            'meta' => [
                'page_index' => intval($params['page_index']),
                'page_size' => intval($params['page_size']),
                'records' => $total,
                'pages' => ceil($total / $params['page_size'])
            ]
        ]);

    }
}
