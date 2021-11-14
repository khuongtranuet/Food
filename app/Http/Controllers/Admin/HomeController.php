<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Ward;
use App\Repositories\HomeRepo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeRepo;
    /**
     * HomeController constructor.
     */
    public function __construct(HomeRepo $homeRepo)
    {
        $this->homeRepo = $homeRepo;
    }

    /**
     * Hàm lấy dữ liệu quận/huyện từ tỉnh theo ajax
     * URL: /admin/home/ajax_district
     * @param Request $request
     */
    public function ajax_district(Request $request) {
        $district = District::where('province_id', $request->id_address)->get();
        return view('admin/ajax/ajax_address_view', ['district' => $district] );
    }

    /**
     * Hàm lấy dữ liệu xã/phường từ quận/huyện theo ajax
     * URL: /admin/home/ajax_ward
     * @param Request $request
     */
    public function ajax_ward(Request $request) {
        $ward = Ward::where('district_id', $request->id_address)->get();
        return view('admin/ajax/ajax_address_view', ['ward' => $ward] );
    }
}
