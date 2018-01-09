<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ProductModel extends Model
{
     public static function get_product($pages) {
        $result = DB::table('product')->paginate($pages);
       return $result;
    }
    public static function get_product_paging($pages) {
        return DB::table('product as s')
                ->select('s.*' , 'l.name as cate_name')
                ->join('categories as l','s.cate_id','=','l.id')
                ->paginate($pages);
    }
    public static function insert_product($product_content) {
        return DB::table('product')->insert($product_content);
    }
    public static function get_product_by_id($id) {
        $result = DB::table('product')
                ->where('id', '=', $id)
                ->get();

        if (empty($result[0])) {
            return FALSE;
        }
        return $result[0];
    }
    public static function get_product_by_cate($cate_id, $pages) {
        return $result = DB::table('product as s')
                ->select('s.*' , 'l.name as cate_name')
                ->where('cate_id', '=', $cate_id)
                ->join('categories as l','s.cate_id','=','l.id')
                ->paginate($pages);
    }
    public static function get_product_by_cate_all($cate_id) {
        return $result = DB::table('product')
                ->where('cate_id', '=', $cate_id)
                ->get();

    }
    public static function update_product($id, $content) {
        return DB::table('product')
                ->where('id', $id)
                ->update($content);
    }
    public static function search_product($name) {
        return DB::table('product as s')
                ->select('s.*' , 'l.name as cate_name')
                ->where('s.name','like','%'.$ten.'%')
                ->join('categories as l','s.cate_id','=','l.id')
                ->get();
    }
    public static function delete_product($id) {
        return DB::table('product')
                ->where('id','=',$id)
                ->delete();
    }

}
