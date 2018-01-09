<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\ProductModel;
use Illuminate\Support\Facades\Input;
use Validator;
use File;
use App\Http\Models\CategoriesModel;

class ProductController extends Controller
{
	public function __construct() {
    }
    public function index(Request $request) {
        //Get and search Products
        if (isset($_POST['tim'])) {
            $search = $_POST['tim'];
            $product = ProductModel::search_product($search);
        } else {
            $search = '';
            $product = ProductModel::get_product_paging(5);
        }
        $data = array(
                'product'=>$product,
                'search'=>$search
        );
        return view('product.list')->with($data); 
	}

    /**
     * Show form create products.
     *
     * @return Response
     */
	public function create() {
        $cate = categoriesModel::get_categories_all();
        return view('product.insert',compact('cate'));
    }

    /**
     * Store a new products.
     *
     * @param Request $request
     * @return Response
     */
    public function store (Request $request) {
        //Check file
        $v = Validator::make($request->all(),
            [
                'name' => 'required|unique:product,name',
                'cate_id' => 'required',
                'cost' => 'required',
                'image' =>'required'
            ],
            [
                'name.required' => 'Vui lòng nhập tên sản phẩm',
                'name.unique' => 'Tên sản phẩm không được trùng',
                'cate_id.required' => 'Vui lòng nhập mã loại',
                'cost.required' => 'vui lòng nhập đơn giá',
                'image.required' => 'vui lòng chọn hình'
            ]
        );
        if($v->fails())
            return redirect()->back()->withErrors($v->errors());

        $file = $request->file('image');
        $img_name = $file->getClientOriginalName();

        //check images
        if ($img_name == null) {
        	$request->session()->flash('fail','that bai');
        	return back();
        }

        //create a new image name 
        $tmp = explode('.', $img_name);
        $new_img = "$tmp[0]".time()."."."$tmp[1]";
        // Create item to insert db
        $product = [
            'name' => $_POST['name'],
            'cate_id' => $_POST['cate_id'],
            'cost' => $_POST['cost'],
            'images'    => $new_img,
            'view' => 0
        ];
        
        //process insert
        if (ProductModel::insert_product($product)) {
            //Move file to server
            $file->move("public/images",$new_img);
            $request->session()->flash('ok','thanh cong');
            return back();
        } else {
            $request->session()->flash('fail','that bai');
            return back();
        }
    }

    /**
     * Edit a product.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        // Get blog
        $product = ProductModel::get_product_by_id($id);
        $cate= CategoriesModel::get_categories_all();
        $data = array(
                'product'=>$product,
                'cate'=>$cate
        );
        return view('product.edit')->with($data);
    }

    /**
     * Update a product.
     *
     * @param int $id
     * @return Response
     */
    public function update($id, Request $request) {
        $v = Validator::make($request->all(),
            [
                'name' => 'required',
                'cate_id' => 'required',
                'cost' => 'required'
            ],
            [
                'name.required' => 'Vui lòng nhập tên sản phẩm',
                'cate_id.required' => 'Vui lòng nhập mã loại',
                'cost.required' => 'vui lòng nhập đơn giá'
            ]
        );
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors());

        //check images
     	$product = ProductModel::get_product_by_id($id);
     	$file = $request->file('image');
     	$old_img = $product->images;
        $new_img = $old_img;
        if ($file!=null) {
        	$new_img = $file->getClientOriginalName();
            //$file->move("public/images",$ten_hinh);
        }

        //create array to update to DB
     	$content = [
     		'name' => $_POST['name'],
     		'cate_id' => $_POST['cate_id'],
            'cost' => $_POST['cost'],
            'images'    => $new_img
     	];

        //process update
     	if (ProductModel::update_product($id,$content)) {
            //Move file to server
            if ($old_img != $new_img) {
                if (file_exists(public_path('images/'.$old_img)))
                    unlink(public_path('images/'.$old_img));
                $file->move("public/images",$new_img);
            }
            $request->session()->flash('ok',$new_img.$product->images);
            return redirect()->route('product.list');
        } else {
            $request->session()->flash('fail',$new_img.$product->images);
            return redirect()->back();
        }
    }

    /**
     * Delete a product.
     *
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function delete ($id,Request $request) {
        //get old_image
        $product = ProductModel::get_product_by_id($id);
        $old_image = $product->images;

        //process delete
        if (ProductModel::delete_product($id)) {
            File::delete(public_path('images/'.$old_image));
            $request->session()->flash('ok','Sản phẩm đã được xóa');
            return back();
        }
    }

}