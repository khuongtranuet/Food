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
            $data = $this->cartRepo->productCart($checkTokenIsValid->user_id, true);

            return response()->json([
                'code' => 200,
                'data' => $data[0]->food,
                'meta' => [],
            ], 200);
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/carts/update
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
            $message = 'Chỉnh sửa giỏ hàng thành công';
            if ($request->quantity == 0) {
                $message = 'Xóa sản phẩm khỏi đơn hàng thành công';
            }
            if (is_array($params['food_id'])) {
                $message = 'Chuyển checkout thành công';
            }
            return response()->json([
                'code' => 200,
                'message' => $message,
                'meta' => [],
            ], 200);
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/carts/add
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $params['customer_id'] = $checkTokenIsValid->user_id;
            $params['food_id'] = $request->food_id;
            $params['quantity'] = $request->quantity;
            $insert = $this->cartRepo->insertCart($params);
            if (isset($insert) && $insert) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
                    'meta' => [],
                ], 200);
            }
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/carts/delete/{id}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id = null) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            if ($id != null) {
                $params['food_id'] = $id;
                $params['quantity'] = 0;
            }else{
                $params['quantity'] = '';
                $params['is_delete'] = true;
            }
            $params['customer_id'] = $checkTokenIsValid->user_id;
            $this->cartRepo->updateCart($params);
            return response()->json([
                'code' => 200,
                'message' => 'Xóa sản phẩm khỏi đơn hàng thành công',
                'meta' => [],
            ], 200);
        }
    }
}
