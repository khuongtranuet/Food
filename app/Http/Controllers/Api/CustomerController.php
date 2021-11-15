<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Province;
use App\Models\SessionUser;
use App\Repositories\CustomerRepo;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerRepo;

    /**
     * CustomerController constructor.
     */
    public function __construct(CustomerRepo $customerRepo) {
        $this->customerRepo = $customerRepo;
    }

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

    public function address(Request $request) {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
        if (!empty($checkTokenIsValid)) {
            $data = $this->customerRepo->addressCustomer($checkTokenIsValid->user_id, false);

            return response()->json([
               'code' => 200,
               'data' => $data,
               'meta' => [],
            ], 200);
        }
    }

    public function provinces() {
        $data = $this->customerRepo->select('*', constants('db_table.TBL_PROVINCES'));
        return response()->json([
            'code' => 200,
            'data' => $data,
            'meta' => [],
        ], 200);
    }

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
}
