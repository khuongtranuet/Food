<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use App\Repositories\CartRepo;
use App\Repositories\CustomerRepo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartRepo;
    protected $customerRepo;

    /**
     * CartController constructor.
     */
    public function __construct(CartRepo $cartRepo, CustomerRepo $customerRepo)
    {
        $this->cartRepo = $cartRepo;
        $this->customerRepo = $customerRepo;
    }

    /**
     * URL: http://localhost:8000/api/v1/carts
     * http://localhost:8000/api/v1/carts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $data = $this->cartRepo->productCart($checkTokenIsValid->user_id);

            return response()->json([
                'code' => 200,
                'data' => $data[0]->food,
                'meta' => [],
            ], 200);
        }
    }

    public function update(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $params['food_id'] = $request->food_id;
            $params['quantity'] = $request->quantity;
            $params['customer_id'] = $checkTokenIsValid->user_id;
            $params['is_delete'] = $request->is_delete;
            $address_customer = $this->customerRepo->addressCustomer($params['customer_id'], false, true);
            $params['address_id'] = $address_customer[0]['id'];
            $update_cart = $this->cartRepo->updateCart($params);

            return response()->json([
                'code' => 200,
                'message' => 'Chỉnh sửa giỏ hàng thành công',
                'meta' => [],
            ], 200);
        }
    }
}
