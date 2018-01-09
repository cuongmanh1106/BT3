<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CategoriesModel extends Model
{
	public static function get_categories($pages) {
        $result = DB::table('categories')->paginate($pages);
       return $result;
    }
    public static function get_categories_all() {
        $result = DB::table('categories')->get();
       return $result;
    }

    public static function get_categories_by_id($id)
    {
    	$result = DB::table('categories')
                ->where('id', '=', $id)
                ->get();

        if (empty($result[0])) {
            return FALSE;
        }
        return $result[0];
    }

    public static function insert($data)
    {
    	return DB::table('categories')->insert($data);
    }
    public static function update_cagtegories($id, $content) {
        return DB::table('categories')
                ->where('id', $id)
                ->update($content);
    }
    public static function delete_categories($id)
    {
    	return DB::table('categories')
    			->where('id','=',$id)
    			->delete();
    }
}