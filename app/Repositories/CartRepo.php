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

    public function productCart($id) {
        $query = Customer::select('*');
        $query->where('id', $id);
        $query->with([
            'food' => function ($sql) {
                $sql->select('*');
            },
        ]);
        return $query->get();
    }

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
                Cart::where('customer_id', $customer_id)->where('food_id', $food_id)->delete();
            }
        }
        return '1';
    }
}
