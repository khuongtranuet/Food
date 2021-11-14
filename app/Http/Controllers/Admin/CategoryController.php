<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryAddRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Repositories\CategoryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepo;

    /**
     * CategoryController constructor.
     */
    public function __construct(CategoryRepo $category)
    {
        $this->categoryRepo = $category;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    /**
     * Danh sách các danh mục
     * URL: /admin/category/index
     */
    public function index()
    {
        $categories = DB::table(constants('db_table.TBL_CATEGORIES'))->orderBy('id', 'DESC')->paginate(10);
        return view('admin/category/list_view', ['categories' => $categories]);
    }

    /**
     * Hàm lấy dữ liệu danh mục phân trang theo ajax
     * URL: /admin/category/ajax_list
     * @param Request $request
     */
    public function ajax_list(Request $request)
    {
        $params['keyword'] = request('keyword', null);
        $params['type'] = request('type', -1);
        $params['page_index'] = request('page_index', 1);
        $params['page_size'] = request('page_size', 10);

        if ($params['page_index'] < 1) {
            $params['page_index'] = 1;
        }
        $from = $params['from'] = ($params['page_index'] - 1) * $params['page_size'];


        $total_record = $this->categoryRepo->listing($params, true);
        $result_category = $this->categoryRepo->listing($params, false);
        $pagination_link = paginate_ajax($total_record, $params['page_index'], $params['page_size']);
        return view('admin/category/ajax_list_view', [
            'result_category' => $result_category,
            'from' => $from,
            'pagination_link' => $pagination_link,
        ]);
    }

    /**
     * Hàm lấy dữ liệu view thêm danh mục
     * URL: /admin/category/add
     */
    public function add()
    {
        $category_id = DB::table(config('constants.db_table.TBL_CATEGORIES'))->get();
        return view('admin/category/add_view', ['category_id' => $category_id]);
    }

    /**
     * Hàm thêm mới danh mục
     * URL: /admin/category/store
     */
    public function store(CategoryAddRequest $request)
    {
        $image_name = null;
        if (isset($request->image) && $request->image) {
            $image_name = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/category_images'), $image_name);
        }
        $category = array();
        $category['name'] = $request->name;
        $category['slug'] = Str::slug($request->name);
        $category['description'] = $request->description;
        $category['image_path'] = $image_name;

        $insert = $this->categoryRepo->insertCategory($category);
        $request->session()->flash('success', 'Thêm danh mục mới thành công!');
        return redirect()->route('admin.category.index');
    }

    /**
     * Lấy dữ liệu view chỉnh sửa danh mục
     * URL: /admin/category/detail/(id danh mục)
     * @param :
     * $category_id: Danh sách các danh mục
     * $old_value: Dữ liệu danh mục đang được chỉnh sửa
     */
    public function edit($id = null) {
        $category_id = Category::all();
        $old_value = Category::where('id', $id)->get();
        return view('admin/category/edit_view', ['category_id' => $category_id, 'old_value' => $old_value[0]]);
    }

    /**
     * Hàm chỉnh sửa danh mục
     * URL: /admin/category/update
     */
    public function update($id, CategoryUpdateRequest $request) {
        $category = Category::where('id', $id)->get();
        $image_name = $category[0]->image;
        if (isset($request->image) && $request->image) {
            if(file_exists(public_path('uploads/category_images/'.$category->image))) {
                unlink(public_path('uploads/category_images/'.$category->image));
            }
            $image_name = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/category_images'), $image_name);
        }
        $update_category = array();
        if (isset($request->name) && $request->name) {
            $update_category['name'] = $request->name;
            $update_category['slug'] = Str::slug($request->name);
        }
        if (isset($request->description) && $request->description) {
            $update_category['description'] = $request->description;
        }
        if (isset($request->image) && $request->image) {
            $update_category['image'] = $image_name;
        }
        $update = Category::where('id', $id)->update($update_category);
        if (isset($update) && $update) {
            $request->session()->flash('success', 'Cập nhật danh mục thành công!');
            return redirect()->route('admin.category.index');
        }
        return redirect()->route('admin.category.index');
    }

    /**
     * Chi tiết thông tin danh mục
     * URL: /admin/category/detail/(id danh mục)
     */
    public function detail($id = null) {
        $result = Category::where('id', $id)->get();
        $data['result'] = $result[0];
        return view('admin/category/detail_view', [
            'data_category' => $data,
        ]);
    }

    /**
     * Hàm xóa danh mục
     * URL: /admin/category/delete/{id danh mục}
     */
    public function delete($id = null) {
        $delete = Category::where('id', $id)->delete();
        if (isset($delete)) {
            return redirect()->route('admin.category.index')->with('success', 'Xóa danh mục thành công!');
        }
    }
}
