<?php


namespace App\Repositories;


use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderFood;
use App\Models\Food;

class CustomerRepo extends BaseRepo
{
    /**
     * CustomerRepo constructor.
     */
    public function __construct()
    {

    }

    /**
     * Hàm lấy danh sách
     *
     * @param $params
     * @param false $is_counting
     */
    public function listing($params, $is_counting=false)
    {
        $page_index = isset($params['page_index']) ? $params['page_index'] : 1;
        $page_size = isset($params['page_size']) ? $params['page_size'] : 10;
        $from = isset($params['from']) ? $params['from'] : 0;
        $keyword = isset($params['keyword']) ? $params['keyword'] : null;
        $type = isset($params['type']) ? $params['type'] : -1;
        $status = isset($params['status']) ? $params['status'] : -1;

        // Tạo truy vấn ban đầu, xử lý trường cần trả về
        $query = Customer::select('*');
        $query->where('id', '>', 0);

        // Tìm kiếm tương đối theo từ khóa
        $query->when(!empty($keyword), function ($sql) use ($keyword) {
            $keyword = translateKeyWord($keyword);
            return $sql->where(function ($sub_sql) use ($keyword) {
                $sub_sql->where('fullname', 'LIKE', "%" . $keyword . "%")
                    ->orWhere('email', 'LIKE', "%" . $keyword . "%")
                    ->orWhere('mobile', 'LIKE', "%" . $keyword . "%");
            });
        });

        // Lọc theo loại người dùng, nếu -1 thì không lọc
        if (isset($type) && $type != -1) {
            $query->where('type', $type);
        }
        // Lọc theo trạng thái, nếu -1 thì không lọc
        if (isset($status) && $status != -1) {
            $query->where('status', $status);
        }

        // Nếu lấy tổng số bản ghi thì trả về số bản ghi, ngược lại thì phân trang
        if ($is_counting) {
            return $query->count();
        } else {
            $offset = ($page_index - 1) * $page_size;
            if ($page_size > 0 && $offset >= 0) {
                $query->take($page_size)->skip($offset);
            }
        }

        $query->orderBy('id', 'DESC');
        // Trả về kết quả
        return $query->get();
    }

    /**
     * Hàm xử lý thêm mới khách hàng
     *
     * @param $params
     * $data : các dữ liệu của khách hàng
     * $is_customer : false
     */
    public function insertCustomer($data, $is_customer = false) {
        $customer = array();
        $address = array();
        if (isset($data['fullname']) && $data['fullname'] != null) {
            $customer['fullname'] = $data['fullname'];
        }
        if (isset($data['birthday']) && $data['birthday'] != null) {
            $customer['birthday'] = $data['birthday'];
        }
        if (isset($data['mobile']) && $data['mobile'] != null) {
            $customer['mobile'] = $data['mobile'];
        }
        if (isset($data['email']) && $data['email'] != null) {
            $customer['email'] = $data['email'];
        }
        if (isset($data['gender']) && $data['gender'] != null) {
            $customer['gender'] = $data['gender'];
        }
        if (isset($data['password']) && $data['password'] != null) {
//			$customer['password'] = $data['password'];
            $customer['password'] = hash('sha256', $data['password'].constants('TOKEN')) ;
        }
        if (isset($data['status']) && $data['status'] != null) {
            $customer['status'] = $data['status'];
        }
        if (isset($data['type']) && $data['type'] != null) {
            $customer['type'] = $data['type'];
        }
        $customer['created_at'] = date('Y-m-d H:i:s');
        $customer['updated_at'] = date('Y-m-d H:i:s');

        if (isset($data['province']) && $data['province'] != null) {
            $address['province_id'] = $data['province'];
        }
        if (isset($data['district']) && $data['district'] != null) {
            $address['district_id'] = $data['district'];
        }
        if (isset($data['ward']) && $data['ward'] != null) {
            $address['ward_id'] = $data['ward'];
        }
        if (isset($data['address']) && $data['address'] != null) {
            $address['address'] = $data['address'];
        }
        if (isset($data['fullname_address']) && $data['fullname_address'] != null) {
            $address['fullname'] = $data['fullname_address'];
        }
        if (isset($data['mobile_address']) && $data['mobile_address'] != null) {
            $address['mobile'] = $data['mobile_address'];
        }
        if (isset($data['type_address']) && $data['type_address'] != null) {
            $address['type'] = $data['type_address'];
        }
        if (isset($data['status_address']) && $data['status_address'] != null) {
            $address['status'] = $data['status_address'];
        }
        if (isset($data['fullname']) && $data['fullname'] != null) {
            $address['fullname'] = $data['fullname'];
        }
        if (isset($data['mobile']) && $data['mobile'] != null) {
            $address['mobile'] = $data['mobile'];
        }
        $address['created_at'] = date('Y-m-d H:i:s');
        $address['updated_at'] = date('Y-m-d H:i:s');

        $id_customer = Customer::where('mobile', $data['mobile'])->get();
        $update = array('status' => 0,);
        if (isset($id_customer) && count($id_customer) > 0) {
            Address::where('customer_id', $id_customer->id)->update($update);
        }
        if ($is_customer == true) {
            $check_exist = Customer::select('*')->where('mobile', $data['mobile']);
            $check_exist->with([
                'address' => function ($sql) {
                    $sql->select('*');
                },
                'order' => function ($sql) {
                    $sql->select('*')->where('status', -2);
                }
            ]);
            $check_exist = $check_exist->get();
            if (count($check_exist[0]->order) > 0) {
                $check_address = Order::where('address_id', ($check_exist[0]->order)[0]->address_id)->get();
                if (count($check_address) == 1 && $check_address[0]->status = -2) {
                    $check_address_customer = Address::where('customer_id', $check_address[0]->customer_id)->get();
                    if (count($check_address_customer) == 1) {
                        OrderFood::where('order_id', ($check_exist[0]->order)[0]->id)->delete();
                        Order::where('id', ($check_exist[0]->order)[0]->id)->delete();
                        Address::where('id', $check_address[0]->address_id)->delete();
                        Customer::where('id', $check_address_customer[0]->customer_id)->delete();
                    }elseif (count($check_address_customer) > 1) {
                        OrderFood::where('order_id', ($check_exist[0]->order)[0]->id)->delete();
                        Order::where('id', ($check_exist[0]->order)[0]->id)->delete();
                        Address::where('id', $check_address[0]->address_id)->delete();
                    }
                }elseif (count($check_address) > 1) {
                    OrderFood::where('order_id', ($check_exist[0]->order)[0]->id)->delete();
                    Order::where('id', ($check_exist[0]->order)[0]->id)->delete();
                }
            }
            $check_customer_exist = Customer::where('mobile', $data['mobile'])->get();
            if (count($check_customer_exist) > 0) {
                $check_address_exist = Address::where('customer_id', $check_customer_exist[0]->id)
                    ->where('mobile', $data['mobile'])->get();
                if (count($check_address_exist) > 0) {
                    for ($i = 0; $i < count($check_address_exist); $i++) {
                        if ($check_address_exist[$i]->province_id == $data['province'] && $check_address_exist[$i]->district_id == $data['district'] &&
                            $check_address_exist[$i]->ward_id == $data['ward']) {
                            $update_address = array(
                                'fullname' => $data['fullname'],
                                'address' => $data['address'],
                            );
                            Address::where('id', $check_address_exist[$i]->id)->update($update_address);
                            $params['address_id'] = $check_address_exist[$i]->id;
                            $is_update = true;
                        }
                    }
                    if (!isset($is_update)) {
                        $address['customer_id'] = $check_customer_exist[0]->id;
                        $insert = Address::insertGetId($address);
                        $params['address_id'] = $insert;
                    }
                }else{
                    $address['customer_id'] = $check_customer_exist[0]->id;
                    $insert = Address::insertGetId($address);
                    $params['address_id'] = $insert;
                }
                $params['customer_id'] = $check_customer_exist[0]->id;
            }else{
                $insert_customer = Customer::insertGetId($customer);
                $params['customer_id'] = $insert_customer;
                $address['customer_id'] = $params['customer_id'];
                $insert = Address::insertGetId($address);
                $params['address_id'] = $insert;
            }
        }
        if($is_customer == true) {
            $_SESSION['customer_id'] = $params['customer_id'];
            $passersby = array();
            $passersby['customer_id'] = $params['customer_id'];
            $passersby['address_id'] = $params['address_id'];
            if (isset($_SESSION['product_id'])) {
                $passersby['product_id'] = $_SESSION['product_id'];
            }
            if (isset($_SESSION['quantity'])) {
                $passersby['quantity'] = $_SESSION['quantity'];
            }
            $this->insertOrderPassersby($passersby);
        }else{
            $address['customer_id'] = Customer::insertGetId($customer);
            Address::insert($address);
        }
        return '1';
    }

    public function insertOrderPassersby($data) {
        $product_id = isset($data['product_id']) ? $data['product_id'] : '';
        $quantity = isset($data['quantity']) ? $data['quantity'] : '';
        $customer_id = isset($data['customer_id']) ? $data['customer_id'] : '';
        if (is_array($product_id) && is_array($quantity) && $customer_id != '') {
            $address_id = isset($data['address_id']) ? $data['address_id'] : '';
            if ($address_id != '') {
                $order_exist = Order::where('customer_id', $customer_id)->where('status', -2)->get();
                if (count($order_exist) > 0) {
                    $order_id = $order_exist[0]->id;
                    OrderFood::where('order_id', $order_id)->delete();

                    Order::where('id', $order_id)->update(['address_id' => $address_id]);
                    foreach ($product_id as $key => $value) {
                        $product_detail = Food::where('id', $product_id[$key])->get();
                        $order_product = array(
                            'product_id' => $product_id[$key],
                            'order_id' => $order_id,
                            'quantity' => $quantity[$key],
                            'unit_price' => $product_detail[0]->price,
                            'total_price' => $product_detail[0]->price * $quantity[$key],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        OrderFood::insert($order_product);
                    }
                } else {
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
                    foreach ($product_id as $key => $value) {
                        $product_detail = Food::where('id', $product_id[$key])->get();
                        $order_product = array(
                            'product_id' => $product_id[$key],
                            'order_id' => $order_id,
                            'quantity' => $quantity[$key],
                            'unit_price' => $product_detail[0]->price,
                            'total_price' => $product_detail[0]->price * $quantity[$key],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        OrderFood::insert($order_product);
                    }
                }
            }
        }
    }

    /**
     * Hàm truy vấn địa chỉ của khách hàng
     * @param $id
     * $is_count, $status_address
     */
    public function addressCustomer($id, $is_count, $status_address = false) {
        $query = Address::select('*');
        $query->where('customer_id', $id);
        if($status_address == true) {
            $query->where('status', '1');
        }
        if($is_count != '' && is_numeric($is_count)) {
            $query->where('id', $is_count);
        }
        if($is_count == true) {
            $query->groupBy('customer_id');
        }
        $query->orderBy('status', 'DESC');

        $query->with([
            'province' => function ($sql) {
                $sql->select('*');
            },
            'district' => function ($sql) {
                $sql->select('*');
            },
            'ward' => function ($sql) {
                $sql->select('*');
            },
            'customer' => function ($sql) {
                $sql->select('*');
            }
        ]);

        return $query->get();
    }

    /**
     * Hàm cập nhật thông tin khách hàng
     * @param $id
     * $data : thông tin cập nhật của khách hàng
     * $params : các điều kiện tùy biến
     */
    public function updateCustomer($data, $id, $params = null) {
        $customer = array();
        $address = array();
        if (isset($data['avatar']) && $data['avatar'] != null) {
            $customer['avatar'] = $data['avatar'];
        }
        if (isset($data['fullname']) && $data['fullname'] != null) {
            $customer['fullname'] = $data['fullname'];
        }
        if (isset($data['birthday']) && $data['birthday'] != null) {
            $customer['birthday'] = $data['birthday'];
        }
        if (isset($data['mobile']) && $data['mobile'] != null) {
            $customer['mobile'] = $data['mobile'];
        }
        if (isset($data['email']) && $data['email'] != null) {
            $customer['email'] = $data['email'];
        }
        if (isset($data['gender']) && $data['gender'] != null) {
            $customer['gender'] = $data['gender'];
        }
        if (isset($data['password']) && $data['password'] != null && isset($data['new_password'])) {
            $customer['password'] = hash('sha256', $data['new_password'].constants('TOKEN')) ;
        }elseif (isset($data['password']) && $data['password'] != null) {
            $customer['password'] = hash('sha256', $data['password'].constants('TOKEN')) ;
        }
        if (isset($data['status']) && $data['status'] != null) {
            $customer['status'] = $data['status'];
        }
        $customer['created_at'] = date('Y-m-d H:i:s');
        $customer['updated_at'] = date('Y-m-d H:i:s');

        if (isset($data['province']) && $data['province'] != null) {
            $address['province_id'] = $data['province'];
        }
        if (isset($data['district']) && $data['district'] != null) {
            $address['district_id'] = $data['district'];
        }
        if (isset($data['ward']) && $data['ward'] != null) {
            $address['ward_id'] = $data['ward'];
        }
        if (isset($data['address']) && $data['address'] != null) {
            $address['address'] = $data['address'];
        }
        if (isset($data['fullname_address']) && $data['fullname_address'] != null) {
            $address['fullname'] = $data['fullname_address'];
        }
        if (isset($data['mobile_address']) && $data['mobile_address'] != null) {
            $address['mobile'] = $data['mobile_address'];
        }
        if (isset($data['type_address']) && $data['type_address'] != null) {
            $address['type'] = $data['type_address'];
        }
        if (isset($data['status_address']) && $data['status_address'] != null) {
            $address['status'] = $data['status_address'];
        }
        if (!isset($params['update_client'])) {
            $address['created_at'] = date('Y-m-d H:i:s');
            $address['updated_at'] = date('Y-m-d H:i:s');
        }

        Customer::where('id', $id)->update($customer);
        if (!isset($params['update_client'])) {
            $address_id = Address::where('customer_id', $id)->where('status', '1')->get();
            $address_id = $address_id[0]->id;
            Address::where('id', $address_id)->update($address);
        }
        return '1';
    }

    /**
     * Hàm xóa khách hàng
     * @param $id : id khách hàng cần xóa
     */
    public function deleteCustomer($id) {
        $query = Address::whereIn('customer_id', Customer::select('id')->where('id', $id))->delete();

        $result = Customer::where('id', $id)->delete();
        if (isset($result)) {
            return '1';
        }
    }
}
