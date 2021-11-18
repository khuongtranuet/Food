<?php


namespace App\Repositories;


use App\Models\Order;

class PaymentRepo extends BaseRepo
{
    /**
     * PaymentRepo constructor.
     */
    public function __construct()
    {
    }

    /**
     * Hàm cập nhật thông tin đơn hàng
     * @param $data : dữ liệu thông tin đơn hàng
     * @param bool $is_vnpay : false
     */
    public function updateOrder($data, $is_vnpay = false)
    {
        $order = array();
        if (isset($data['customer_id']) && $data['customer_id']) {
            $order_id = Order::select('id')->where('customer_id', $data['customer_id'])->where('status', -2)->get();
            if (isset($data['order_date']) && $data['order_date']) {
                $order['order_date'] = $data['order_date'];
            }
            if (isset($data['total_bill']) && $data['total_bill']) {
                $order['total_bill'] = $data['total_bill'];
                $order['total_pay'] = $data['total_bill'];
            }
            if (isset($data['payment_method']) && $data['payment_method']) {
                $order['payment_method'] = $data['payment_method'];
            }
            if (isset($data['payment_status']) && $data['payment_status']) {
                $order['payment_status'] = $data['payment_status'];
            }
            if (isset($data['status'])) {
                $order['status'] = $data['status'];
            }
            if (isset($data['order_code']) && $data['order_code']) {
                $order['code'] = $data['order_code'];
            }
            $order['updated_at'] = date('Y-m-d H:i:s');
            Order::where('customer_id', $data['customer_id'])->where('status', -2)->update($order);
            if ($is_vnpay == true) {
                return $order_id[0]['id'];
            }else{
                return $order_id[0]['id'];
//                return '1';
            }
        }
    }
}
