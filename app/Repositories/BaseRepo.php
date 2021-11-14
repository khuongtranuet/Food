<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class BaseRepo
{
    /**
     * Hàm truy vấn dữ liệu theo tham số truyền vào
     */
    public function select($select, $tbl, $params = '') {
//        $select = str_replace("'", '', $select);
        $query = DB::table($tbl)->select($select);
        if (isset($params['where']) && is_array($params['where']) && count($params['where']) > 0) {
            foreach ($params['where'] as $where) {
                $query->where($where['field'], $where['data']);
            }
        }
        if (isset($params['where_column']) && is_array($params['where_column']) && count($params['where_column']) > 0) {
            foreach ($params['where_column'] as $where_column) {
                $query->whereColumn($where_column['field'], $where_column['same_field']);
            }
        }
        if (isset($params['order_by']) && is_array($params['order_by']) && count($params['order_by']) > 0) {
            foreach ($params['order_by'] as $order_by) {
                $query->orderBy($order_by['field'], $order_by['direction']);
            }
        }
        return $query->get();
    }
}
