<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use File;
use App\Http\Models\CategoriesModel;
use App\Http\Models\ProductModel;

Class CategoriesController extends Controller
{
    public function __construct() {

    }
    /**
     * Show list and search categories.
     *
     * @return Response
     */
    public function index (Request $request) {
        $cates = CategoriesModel::get_categories(5);
        return view('categories.list',compact('cates'));

    }

    /**
     * Show form create blog.
     *
     * @return Response
     */

    public function create() {
        return view('categories.insert');
    }

    /**
     * Store a new categories.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $v = Validator::make($request->all(),
            [
                'name'=>'required'
            ],
            [
                'name.required'=>'Vui lòng nhập tên loại'
            ]
        );
        if($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }
        $date = [
            'name' => $_POST['name']
        ];

        //process insert
        if(CategoriesModel::insert($date)) {
            $request->session()->flash('alert-success','Thành công');
            return back();
        } else {
            $request->session()->flash('alert-danger','thất bại');
            return back();
        }
    }

     /**
     * Edit a category.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id, Request $request) {
        $cate = CategoriesModel::get_categories_by_id($id);
        return view('categories.edit',compact('cate'));
    }

    /**
     * Update a category.
     *
     * @param int $id
     * @return Response
     */
    public function update($id,Request $request) {
        $v = Validator::make($request->all(),
            [
                'name'=>'required'
            ],
            [
                'name.required'=>'Vui lòng nhập tên loại'
            ]
        );
        if($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        $date = [
            'name' => $_POST['name']
        ];

        if(CategoriesModel::update_cagtegories($id,$date)) {
            $request->session()->flash('alert-success','Thành công');
            return redirect()->route('categories.list');
        } else {
            $request->session()->flash('alert-danger','thất bại');
            return back();
        }
    }

    /**
     * Delete a category.
     *
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function delete($id , Request $request) {
        $count = count(ProductModel::get_product_by_cate_all($id));
        if($count == 0) {
            if(CategoriesModel::delete_categories($id)) {
                $request->session()->flash('alert-success','Thành công');
                return redirect()->back();
            } else {
                $request->session()->flash('alert-danger','thất bại');
                return back();
            }
        } else {
            $request->session()->flash('none','đã có sản phẩm thuộc loại này');
            return back();
        }
    }
    public function list_pro($id , Request $request) {
        $product = ProductModel::get_product_by_cate($id,5);
        $search = '';
        return view('product.list' , compact('product','search')); 
    }
}