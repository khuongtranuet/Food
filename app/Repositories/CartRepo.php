<?php


namespace App\Repositories;


use App\Models\Cart;
use App\Models\Customer;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderFood;

class CartRepo extends BaseRepo
{
    /**
     * CartRepo constructor.
     */
    public function __construct()
    {
    }

    /**
     * Hàm lấy dữ liệu sản phẩm trong giỏ hàng
     * @param $id : id của khách hàng cần lấy thông tin
     * @param bool $is_cart
     */
    public function productCart($id , $is_cart = false) {
        if($is_cart == true) {
            $query = Customer::select('*');
            $query->where('id', $id);
            $query->with([
                'food' => function ($sql) {
                    $sql->select('*');
                },
            ]);
            return $query->get();
        }else{
            $query = Order::select('*');
            $query->where('id', $id);
            $query->with([
                'food' => function ($sql) {
                    $sql->select('*');
                },
            ]);
            return $query->get();
        }
    }

    /**
     * Hàm chỉnh sửa thông tin sản phẩm trong giỏ hàng
     * @param $data : dữ liệu thông tin sản phẩm thay đổi
     */
    public function updateCart($data) {
        $food_id = isset($data['food_id']) ? $data['food_id'] : '';
        $quantity = isset($data['quantity']) ? $data['quantity'] : '';
        $customer_id = isset($data['customer_id']) ? $data['customer_id'] : '';
        $is_delete = isset($data['is_delete']) ? $data['is_delete'] : '';
        if (is_array($food_id) && $is_delete == true && $customer_id != '') {
            for($i = 0; $i < count($food_id); $i++) {
                Cart::where('customer_id', $customer_id)->where('food_id', $food_id[$i])->delete();
            }
        }elseif (is_array($food_id) && is_array($quantity) && $customer_id != '') {
            $address_id = isset($data['address_id']) ? $data['address_id'] : '';
            if ($address_id != '') {
                $order_exist = Order::where('customer_id', $customer_id)->where('status', -2)->get();
                if(count($order_exist) > 0) {
                    $order_id = $order_exist[0]['id'];
                    OrderFood::where('order_id', $order_id)->delete();

                    Order::where('id', $order_id)->update(['address_id' => $address_id]);
                    for($i = 0; $i < count($food_id); $i++) {
                        $food_detail = Food::where('id', $food_id[$i])->get();
                        $order_food = array(
                            'food_id' => $food_id[$i],
                            'order_id' => $order_id,
                            'quantity' => $quantity[$i],
                            'unit_price' => $food_detail[0]['price'],
                            'total_price' => $food_detail[0]['price']*$quantity[$i],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        OrderFood::insert($order_food);
                    }
                }else{
                    $code = ramdomOrderNumber();
                    $order = array(
                        'customer_id' => $customer_id,
                        'address_id' => $address_id,
                        'code' => $code,
                        'status' => -2,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    $order_id = Order::insertGetId($order);
                    for($i = 0; $i < count($food_id); $i++) {
                        $food_detail = Food::where('id', $food_id[$i])->get();
                        $order_food = array(
                            'food_id' => $food_id[$i],
                            'order_id' => $order_id,
                            'quantity' => $quantity[$i],
                            'unit_price' => $food_detail[0]['price'],
                            'total_price' => $food_detail[0]['price']*$quantity[$i],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        OrderFood::insert($order_food);
                    }
                }
            }
        }else{
            if ($food_id != '' && $quantity != '' && $customer_id != '' && $quantity > 0) {
                $food_cart = array();
                $food_cart['quantity'] = $quantity;
                Cart::where('customer_id', $customer_id)->where('food_id', $food_id)->update($food_cart);
            }else{
                Cart::where('customer_id', $customer_id)->delete();
            }
        }
        return '1';
    }

    /**
     * Hàm thêm mới sản phẩm vào giỏ hàng
     * @param $data : dữ liệu thông tin sản phẩm mới
     */
    public function insertCart($data) {
        $food_id = isset($data['food_id']) ? $data['food_id'] : '';
        $quantity = isset($data['quantity']) ? $data['quantity'] : '';
        $customer_id = isset($data['customer_id']) ? $data['customer_id'] : '';
        if ($food_id != '' && $quantity != '' && $customer_id != '' && !isset($data['address_id'])) {
            $check_exist = Cart::where('food_id', $food_id)->where('customer_id', $customer_id)->get();
            if (count($check_exist) > 0) {
                $food = array(
                    'quantity' => ($check_exist[0]['quantity'] + $quantity),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                Cart::where('food_id', $food_id)->where('customer_id', $customer_id)->update($food);
            }else{
                $food = array(
                    'customer_id' => $customer_id,
                    'food_id' => $food_id,
                    'quantity' => $quantity,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                Cart::insert($food);
            }
        }else{
            $address_id = isset($data['address_id']) ? $data['address_id'] : '';
            if ($address_id != '') {
                $order_exist = Order::where('customer_id', $customer_id)->where('status', -2)->get();
                if(count($order_exist) > 0) {
                    $order_id = $order_exist[0]['id'];
                    OrderFood::where('order_id', $order_id)->delete();

                    Order::where('id', $order_id)->update(['address_id' => $address_id]);

                    $food_detail = Food::select('*')->where('id', $food_id)->get();
                    $order_food = array(
                        'food_id' => $food_id,
                        'order_id' => $order_id,
                        'quantity' => $quantity,
                        'unit_price' => $food_detail[0]['price'],
                        'total_price' => $food_detail[0]['price']*$quantity,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    OrderFood::insert($order_food);
                }else{
                    $code = ramdomOrderNumber();
                    $order = array(
                        'customer_id' => $customer_id,
                        'address_id' => $address_id,
                        'code' => $code,
                        'status' => -2,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    $order_id = Order::insertGetId($order);
                    $food_detail = Food::select('*')->where('id', $food_id)->get();
                    $order_food = array(
                        'food_id' => $food_id,
                        'order_id' => $order_id,
                        'quantity' => $quantity,
                        'unit_price' => $food_detail[0]['price'],
                        'total_price' => $food_detail[0]['price']*$quantity,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    OrderFood::insert($order_food);
                }
            }
        }
        return '1';
    }

    /**
     * Hàm xóa sản phẩm trong giỏ hàng
     * @param $data
     */
    public function deleteCart($data) {
        $food_id = isset($data['food_id']) ? $data['food_id'] : '';
        $customer_id = isset($data['customer_id']) ? $data['customer_id'] : '';
        if ($food_id != '' && $customer_id != '') {
            $result = Cart::where('customer_id', $customer_id)->where('food_id', $food_id)->delete();
            if (isset($result)) {
                return '1';
            }
        }
    }
}
