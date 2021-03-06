<?php


namespace App\Repositories;


use App\Models\Food;

class FoodRepo extends BaseRepo
{
    /**
     * FoodRepo constructor.
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
        $keyword = isset($params['keyword']) ? $params['keyword'] : null;
        $selection = isset($params['selection']) ? $params['selection'] : null;
        $page_index = isset($params['page_index']) ? $params['page_index'] : 1;
        $page_size = isset($params['page_size']) ? $params['page_size'] : 10;
        $category_id = isset($params['category_id']) ? $params['category_id'] : -1;
        $order_by = isset($params['order_by']) ? $params['order_by'] : [];
        $id = isset($params['id']) ? $params['id'] : null;

        // Tạo truy vấn ban đầu, xử lý trường cần trả về
        $array_selection = explode(',', $selection);
        if ($selection && count($array_selection) > 0) {
            $query = Food::select($array_selection);
        } else {
            $query = Food::select('*');
        }

        // Tìm kiếm tương đối theo từ khóa
        $query->when(!empty($keyword), function ($sql) use ($keyword) {
            $keyword = translateKeyWord($keyword);
            return $sql->where(function ($sub_sql) use ($keyword) {
                $sub_sql->where('name', 'LIKE', "%" . $keyword . "%")
                    ->orWhere('slug', 'LIKE', "%" . $keyword . "%")
                    ->orWhere('price', 'LIKE', "%" . $keyword . "%")
                    ->orWhere('description', 'LIKE', "%" . $keyword . "%");
            });
        });

        // Lấy thông tin sản phẩm theo id truyền vào
        if (isset($id) && $id != null) {
            $query->where('id', $id);
        }
        // Lọc theo danh mục, nếu -1 thì lấy tất cả
        if ($category_id > 0) {
            $query->where('category_id', $category_id);
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

        // Xử lý sắp xếp động theo tham số truyền vào, mặc định theo id
        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $order) {
                $query->orderBy($order['field'], $order['direction']);
            }
        } else {
            $query->orderBy('id', 'DESC');
        }

        $query->with([
            'category' => function ($sql) {
                $sql->select(['id', 'name']);
            }
        ]);

        // Trả về kết quả
        return $query->get();

    }
}
