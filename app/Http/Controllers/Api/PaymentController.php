<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\SessionUser;
use App\Repositories\CartRepo;
use App\Repositories\PaymentRepo;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentRepo;
    protected $cartRepo;

    /**
     * PaymentController constructor.
     */
    public function __construct(PaymentRepo $paymentRepo, CartRepo $cartRepo) {
        $this->paymentRepo = $paymentRepo;
        $this->cartRepo = $cartRepo;
    }

    /**
     * URL: http://localhost:8000/api/v1/payments/checkout?type=
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $type = request('type', '');
            if (isset($type) && $type == 0) {
                $params['order_date'] = date('Y-m-d H:i:s');
                $params['total_bill'] = 0;
                $params['customer_id'] = $checkTokenIsValid->user_id;
                $params['payment_method'] = 2;
                $params['payment_status'] = -1;
                $params['status'] = 0;

                $params_exist['where'] = [
                    ['field' => 'customer_id', 'data' => $checkTokenIsValid->user_id],
                    ['field' => 'status', 'data' => -2],
                ];
                $order_exist = $this->paymentRepo->select('*', constants('db_table.TBL_ORDERS'), $params_exist);

                $food_list = ($this->cartRepo->productCart($order_exist[0]->customer_id))[0]->food;
                $params_delete['customer_id'] = $checkTokenIsValid->user_id;
                for ($i = 0; $i < count($food_list); $i++) {
                    $params['total_bill'] += $food_list[$i]->total_price;
                    $params_delete['food_id'] = $food_list[$i]->food_id;
                    $this->cartRepo->deleteCart($params_delete);
                }
                $update_order = $this->paymentRepo->updateOrder($params);

                $params_data['where'] = [[
                    'field' => 'id',
                    'data' => $update_order,
                ]];
                $data = $this->paymentRepo->select('*', constants('db_table.TBL_ORDERS'), $params_data);
                if (isset($update_order) && $update_order) {
                    return response()->json([
                        'code' => 200,
                        'message' => 'Đặt đơn hàng thành công',
                        'data' => $data,
                        'meta' => [],
                    ], 200);
                }
            }
        }
    }
}
