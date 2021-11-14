<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\FoodRepo;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    protected $foodRepo;

    /**
     * CategoryController constructor.
     */
    public function __construct(FoodRepo $foodRepo)
    {
        $this->foodRepo = $foodRepo;
    }
    /**
     * URL: http://localhost:8000/api/v1/foods
     * http://localhost:8000/api/v1/foods?id=&keyword=&selection=
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listing(Request $request)
    {
        $params['keyword'] = request('keyword', null);
        $params['selection'] = request('selection', null);
        $params['category_id'] = request('category', -1);
        $params['page_index'] = request('page_index', 1);
        $params['page_size'] = request('page_size', 10);
        $params['id'] = request('id', null);
        //
        $params['order_by'] = [
            ['field' => 'id', 'direction' => 'DESC']
        ];
        //
        $total = $this->foodRepo->listing($params, true);
        $data = $this->foodRepo->listing($params, false);
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
