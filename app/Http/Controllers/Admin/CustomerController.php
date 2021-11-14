<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerAddRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Repositories\CustomerRepo;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerRepo;

    /**
     * CustomerController constructor.
     */
    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    /**
     * Danh sách khách hàng
     * URL: /admin/customer/index
     */
    public function index()
    {
        return view('admin/customer/list_view');
    }

    /**
     * Hàm lấy dữ liệu khách hàng phân trang theo ajax
     * URL: /admin/customer/ajax_list
     * @param Request $request
     */
    public function ajax_list(Request $request)
    {
        $params['keyword'] = request('keyword', null);
        $params['type'] = request('type', -1);
        $params['status'] = request('status', -1);
        $params['page_index'] = request('page_index', 1);
        $params['page_size'] = request('page_size', 10);
        if ($params['page_index'] < 1) {
            $params['page_index'] = 1;
        }
        $from = $params['from'] = ($params['page_index'] - 1)* $params['page_size'];

        $total_record = $this->customerRepo->listing($params, true);
        $result_customer = $this->customerRepo->listing($params, false);
        $pagination_link = paginate_ajax($total_record, $params['page_index'], $params['page_size']);
        return view('admin/customer/ajax_list_view', [
            'result_customer' => $result_customer,
            'from' => $from,
            'pagination_link' => $pagination_link,
        ]);
    }

    /**
     * Hàm lấy dữ liệu giao diện thêm sản phẩm
     * URL: /admin/product/add
     */
    public function add() {
        $province = Province::all();
        return view('admin/customer/add_view',[
            'province' => $province,
        ]);
    }

    /**
     * Hàm thêm mới sản phẩm
     * URL: /admin/product/store
     * @param CustomerAddRequest $request
     */
    public function store(CustomerAddRequest $request) {
        $customer = array();
        $customer['fullname'] = $request->fullname;
        if (isset($request->birthday) && $request->birthday) {
            $customer['birthday'] = $request->birthday;
        }
        $customer['mobile'] = $request->mobile;
        $customer['email'] = $request->email;
        $customer['gender'] = $request->gender;
        $customer['password'] = $request->password;
        $customer['status'] = $request->status;
        $customer['type'] = '0';
        $customer['province'] = $request->province;
        $customer['district'] = $request->district;
        $customer['ward'] = $request->ward;
        $customer['address'] = $request->address;
        $customer['fullname_address'] = $request->fullname_address;
        $customer['mobile_address'] = $request->mobile_address;
        $customer['type_address'] = $request->type_address;
        $customer['status_address'] = $request->status_address;

        $insert_customer = $this->customerRepo->insertCustomer($customer);
        if (isset($insert_customer) && $insert_customer) {
            $request->session()->flash('success', 'Thêm khách hàng mới thành công!');
            return redirect()->route('admin.customer.index');
        }
    }

    /**
     * Hàm lấy dữ liệu chi tiết khách hàng
     * URL: /admin/customer/detail/{id khách hàng}
     * @param $id : id của khách hàng đang xét
     */
    public function detail($id = null) {
        if (!isset($id) || $id == NULL) {
            return redirect()->route('admin.customer.index');
        }

        if (is_numeric($id)) {
            $customer = Customer::where('id', $id)->get();
            $address = $this->customerRepo->addressCustomer($id, false);
            if (count($customer) == 0) {
                $customer = Customer::where('id', $id)->get();
                if (count($customer) == 0) {
                    return redirect()->route('admin.customer.index')->with('error', 'Người dùng không tồn tại!');
                }
            }
        }else{
            return redirect()->route('admin.customer.index')->with('error', 'Người dùng không tồn tại!');
        }
        return view('admin/customer/detail_view', [
            'customer' => $customer,
            'address' => $address,
            'id' => $id,
        ]);
    }

    /**
     * Lấy dữ liệu view chỉnh sửa khách hàng
     * URL: /admin/customer/edit/(id khách hàng)
     * @param :
     * $id : id khách hàng đang được chỉnh sửa
     */
    public function edit($id = null) {
        if (is_numeric($id)) {
            $province = Province::all();
            $customer = $this->customerRepo->addressCustomer($id, true, true);
            if (count($customer) == 0) {
                $customer = Customer::where('id', $id)->get();
                if (count($customer) == 0) {
                    return redirect()->route('admin.customer.index')->with('error', 'Người dùng không tồn tại!');
                }
            }
            $district = '';
            $ward = '';
//            dd($customer);
            if (isset($customer[0]->province_id) && isset($customer[0]->district_id)
                && $customer[0]->province_id && $customer[0]->district_id) {
                $province_id = $customer[0]->province_id;
                $district_id = $customer[0]->district_id;
                $district = District::where('province_id', $province_id)->get();
                $ward = Ward::where('district_id', $district_id)->where('province_id', $province_id)->get();
            }
        }else{
            return redirect()->route('admin.customer.index')->with('error', 'Người dùng không tồn tại!');
        }
        return view('admin/customer/edit_view', [
            'customer' => $customer,
            'province' => $province,
            'district' => $district,
            'ward' => $ward,
        ]);
    }

    /**
     * Hàm chỉnh sửa thông tin khách hàng
     * URL: /admin/customer/update
     * @param $id
     * @param CustomerUpdateRequest $request
     */
    public function update($id ,CustomerUpdateRequest $request) {
        if (is_numeric($id)) {
            $province = Province::all();
            $data_customer = $this->customerRepo->addressCustomer($id, true, true);
            if (count($data_customer) == 0) {
                return redirect()->route('admin.customer.index')->with('error', 'Người dùng không tồn tại!');
            }
            $province_id = $data_customer[0]['province_id'];
            $district_id = $data_customer[0]['district_id'];
            $district = District::where('province_id', $province_id)->get();
            $ward = Ward::where('district_id', $district_id)->where('province_id', $province_id)->get();
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $customer = array();
                $customer['fullname'] = $request->fullname;
                if (isset($request->birthday) && $request->birthday) {
                    $customer['birthday'] = $request->birthday;
                }
                $customer['mobile'] = $request->mobile;
                $customer['email'] = $request->email;
                $customer['gender'] = $request->gender;
                $customer['password'] = $request->password;
                $customer['status'] = $request->status;
                $customer['province'] = $request->province;
                $customer['district'] = $request->district;
                $customer['ward'] = $request->ward;
                $customer['address'] = $request->address;
                $customer['fullname_address'] = $request->fullname_address;
                $customer['mobile_address'] = $request->mobile_address;
                $customer['type_address'] = $request->type_address;
                $customer['status_address'] = $request->status_address;

                $update_customer = $this->customerRepo->updateCustomer($customer, $id);
                if (isset($update_customer) && $update_customer) {
                    $request->session()->flash('success', 'Chỉnh sửa thông tin khách hàng thành công!');
                    return redirect()->route('admin.customer.index');
                }
            }
        }else{
            return redirect()->route('admin.customer.index')->with('error', 'Người dùng không tồn tại!');
        }
    }

    /**
     * Hàm xóa khách hàng
     * URL: /admin/customer/delete/{id khách hàng}
     */
    public function delete($id = null) {
        if (!isset($id) || $id == NULL) {
            return redirect()->route('admin.customer.index');
        }
        if (is_numeric($id)) {
            $customer = Customer::where('id', $id)->get();
            if (count($customer) == 0) {
                return redirect()->route('admin.customer.index')->with('error', 'Người dùng không tồn tại!');
            }
            $delete = $this->customerRepo->deleteCustomer($id);
            if (isset($delete) && $delete) {
                return redirect()->route('admin.customer.index')->with('success', 'Xóa khách hàng thành công!');
            }
        }else {
            return redirect()->route('admin.customer.index')->with('error', 'Người dùng không tồn tại!');
        }
    }
}
