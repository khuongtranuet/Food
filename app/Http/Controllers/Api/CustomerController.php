<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Province;
use App\Models\SessionUser;
use App\Repositories\CustomerRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    protected $customerRepo;

    /**
     * CustomerController constructor.
     */
    public function __construct(CustomerRepo $customerRepo) {
        $this->customerRepo = $customerRepo;
    }

    /**
     * URL: http://localhost:8000/api/v1/customers
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $data = Customer::select(['id', 'avatar', 'fullname', 'email', 'mobile', 'gender', 'birthday', 'status',
                'type', 'created_at', 'updated_at'])
                ->where('id', $checkTokenIsValid->user_id)->get();
            return response()->json([
                'code' => 200,
                'data' => $data,
                'meta' => [],
            ], 200);
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/customers/update
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $rules = [
                'fullname' => [
                    'required',
                ],
                'mobile' => [
                    'required',
                    'unique:'.config('constants.db_table.TBL_CUSTOMERS').',mobile,'.$checkTokenIsValid->user_id ,
                ],
                'email' => [
                    'required',
                    'unique:'.config('constants.db_table.TBL_CUSTOMERS').',email,'.$checkTokenIsValid->user_id ,
                ],
            ];
            $attribute = [
                'fullname' => 'H??? v?? t??n',
                'email' => 'Email',
                'mobile' => 'S??? ??i???n tho???i',
            ];
            $message = [
                'fullname.required' => ':attribute kh??ng ???????c ????? tr???ng!',
                'email.required' => ':attribute kh??ng ???????c ????? tr???ng!',
                'email.unique' => ':attribute ???? t???n t???i!',
                'mobile.required' => ':attribute kh??ng ???????c ????? tr???ng!',
                'mobile.unique' => ':attribute ???? t???n t???i!',
            ];
            if (isset($request->password) && $request->password) {
                $rules['password'] = [
                    'min:6',
                    function ($attribute, $value, $fail) use ($request) {
                        $check_password = Customer::where('mobile', $request->mobile)->get();
                        if (password_verify($value, $check_password[0]['password']) == false) {
                            return $fail('M???t kh???u c?? kh??ng ch??nh x??c');
                        }
                    }
                ];
                $rules['new_password'] = ['min:6'];
                $rules['confirm_password'] = ['min:6', 'same:new_password'];
                $attribute['password'] = 'M???t kh???u';
                $attribute['new_password'] = 'M???t kh???u m???i';
                $attribute['confirm_password'] = 'X??c nh???n m???t kh???u';
                $message['password.required'] = ':attribute kh??ng ???????c ????? tr???ng';
                $message['new_password.required'] = ':attribute kh??ng ???????c ????? tr???ng';
                $message['confirm_password.required'] = ':attribute kh??ng ???????c ????? tr???ng';
                $message['confirm_password.same'] = ':attribute kh??ng kh???p v???i m???t kh???u m???i';
            }
            if (isset($request->image) && $request->image) {
                $rules['image'] = [
                    'image',
                    'mimes:jpeg,png,jpg,gif,svg',
                    'max:2048',
                ];
                $attribute['image'] = '???nh';
                $message['image.image'] = 'File t???i l??n kh??ng ph???i l?? ???nh';
                $message['image.mimes'] = '???nh kh??ng ????ng ?????nh d???ng';
                $message['image.max'] = 'K??ch th?????c t???i ??a c???a ???nh l?? 2MB';
            }
            $validator = Validator::make($request->all(), $rules, $message, $attribute);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => false,
                    'errors' => $validator->messages(),
                    'meta' => []
                ], 400);
            } else {
                $customer = array();
                $customer['fullname'] = request('fullname', null);
                $customer['mobile'] = request('mobile', null);
                $customer['email'] = request('email', null);
                $customer['gender'] = request('gender', null);
                $customer['birthday'] = request('birthday', null);
                $customer['password'] = request('password', null);
                $customer['new_password'] = request('new_password', null);
                $image_name = null;
                if (isset($request->image) && $request->image) {
                    $image_name = time().'.'.$request->image->extension();
                    $request->image->move(public_path('uploads/avatar_images'), $image_name);
                }
                $customer['avatar'] = $image_name;
                $params['update_client'] = true;
                $update_detail = $this->customerRepo->updateCustomer($customer, $checkTokenIsValid->user_id, $params);
                if (isset($update_detail) && $update_detail) {
                    return response()->json([
                        'code' => 200,
                        'message' => 'Th??ng tin t??i kho???n ???? ???????c c???p nh???t',
                        'meta' => [],
                    ], 200);
                }
            }
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/addresses
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function address(Request $request) {
        $params['id'] = request('id', null);
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            if ($params['id'] != null) {
                $data = $this->customerRepo->addressCustomer($checkTokenIsValid->user_id, $params['id']);
            }else{
                $data = $this->customerRepo->addressCustomer($checkTokenIsValid->user_id, false);
            }

            return response()->json([
               'code' => 200,
               'data' => $data,
               'meta' => [],
            ], 200);
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/provinces
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function provinces() {
        $data = $this->customerRepo->select('*', constants('db_table.TBL_PROVINCES'));
        return response()->json([
            'code' => 200,
            'data' => $data,
            'meta' => [],
        ], 200);
    }

    /**
     * URL: http://localhost:8000/api/v1/districts?province_id=
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function districts(Request $request) {
        $params['where'] = [[
            'field' => 'province_id',
            'data' => $request->province_id,
        ]];
        $data = $this->customerRepo->select('*', constants('db_table.TBL_DISTRICTS'), $params);

        return response()->json([
            'code' => 200,
            'data' => $data,
            'meta' => [],
        ], 200);
    }

    /**
     * URL: http://localhost:8000/api/v1/wards?district_id=
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function wards(Request $request) {
        $params['where'] = [[
            'field' => 'district_id',
            'data' => $request->district_id,
        ]];
        $data = $this->customerRepo->select('*', constants('db_table.TBL_WARDS'), $params);

        return response()->json([
            'code' => 200,
            'data' => $data,
            'meta' => [],
        ], 200);
    }

    /**
     * URL: http://localhost:8000/api/v1/addresses/add
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store_address(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $address = array();
            $address['fullname'] = request('fullname','');
            $address['mobile'] = request('mobile','');
            $address['province'] = request('province','');
            $address['district'] = request('district','');
            $address['ward'] = request('ward','');
            $address['address'] = request('address','');
            $address['type_address'] = request('type_address','');
            $address['customer_id'] = $checkTokenIsValid->user_id;

            $insert = $this->customerRepo->insertAddress($address);
            $params_province['where'] = [[
                'field' => 'id',
                'data' => $address['province'],
            ]];
            $address['province'] = $this->customerRepo->select('*', constants('db_table.TBL_PROVINCES'), $params_province);
            $params_district['where'] = [[
                'field' => 'id',
                'data' => $address['district'],
            ]];
            $address['district'] = $this->customerRepo->select('*', constants('db_table.TBL_DISTRICTS'), $params_district);
            $params_ward['where'] = [[
                'field' => 'id',
                'data' => $address['ward'],
            ]];
            $address['ward'] = $this->customerRepo->select('*', constants('db_table.TBL_WARDS'), $params_ward);

            if (isset($insert) && $insert) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Th??m m???i ?????a ch??? th??nh c??ng',
                    'data' => $address,
                    'meta' => [],
                ], 200);
            }
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/addresses/update/{id}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_address(Request $request, $id = null) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            if (is_numeric($id)) {
                $address = array();
                $address['fullname'] = request('fullname','');
                $address['mobile'] = request('mobile','');
                $address['province'] = request('province','');
                $address['district'] = request('district','');
                $address['ward'] = request('ward','');
                $address['address'] = request('address','');
                $address['type_address'] = request('type_address','');
                $address['customer_id'] = $checkTokenIsValid->user_id;
                $address['address_id'] = $id;

                $insert = $this->customerRepo->updateAddress($address);
                $data = $this->customerRepo->addressCustomer($checkTokenIsValid->user_id, $id);
                $data = $data[0];
                $data->customer->password = '';

                if (isset($insert) && $insert) {
                    return response()->json([
                        'code' => 200,
                        'message' => 'Ch???nh s???a th??ng tin ?????a ch??? th??nh c??ng',
                        'data' => $data,
                        'meta' => [],
                    ], 200);
                }
            }else{
                return response()->json([
                    'code' => 400,
                    'message' => 'ID c???a ?????a ch??? c???n ch???nh s???a ph???i l?? s???',
                    'meta' => [],
                ], 400);
            }
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/addresses/change/{id}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function change_address(Request $request, $id = null) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            if (is_numeric($id)) {
                $params['customer_id'] = $checkTokenIsValid->user_id;
                $params['id'] = $id;
                $change_address = $this->customerRepo->changeAddress($params);
                if (isset($change_address) && $change_address) {
                    return response()->json([
                        'code' => 200,
                        'message' => '???? thay ?????i ?????a ch??? giao h??ng m???c ?????nh',
                        'meta' => [],
                    ], 200);
                }
            }else{
                return response()->json([
                    'code' => 400,
                    'message' => 'ID c???a ?????a ch??? c???n thay ?????i ph???i l?? s???',
                    'meta' => [],
                ], 400);
            }
        }
    }

    /**
     * URL: http://localhost:8000/api/v1/addresses/delete/{id}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_address(Request $request, $id = null) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            if (is_numeric($id)) {
                $params['address_id'] = $id;
                $params['customer_id'] = $checkTokenIsValid->user_id;
                $delete = $this->customerRepo->deleteAddress($params);
                if (isset($delete) && $delete) {
                    return response()->json([
                        'code' => 200,
                        'message' => 'X??a ?????a ch??? th??nh c??ng',
                        'meta' => [],
                    ], 200);
                }
            }else{
                return response()->json([
                    'code' => 400,
                    'message' => 'ID c???a ?????a ch??? c???n x??a ph???i l?? s???',
                    'meta' => [],
                ], 400);
            }

        }
    }
}
