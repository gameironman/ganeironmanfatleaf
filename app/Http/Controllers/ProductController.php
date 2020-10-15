<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImg;
use App\ProductType;
use App\productimg;
use CreateMultipleimagesTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_list = Product::all();
        // $value = Product::with('product_type')->find(1);
        // $item_list = Product::where('class','=','3')->get();
        // find()取得的值為物件[他只能顯示單筆]，如果php那邊有foreach(<<跑陣列)則無法動作
        // dd($item_list);
        // $product_types = ProductType::with('products')->get();
        // dd($product_types);
        return view('admin.product.index',compact('item_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_types = ProductType::with('products')->get();

        return view('admin.product.create',compact('product_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
=======
        // dd($request->file('multiple-image'));


        // $product_types = ProductImg::find(1);

        // $asc = $product_types->product_imgs;
        // dd($product_types, $asc);


>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
        $requestData = $request->all();
        // dd($requestData);
        //判斷request是否有img_url
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $this->fileUpload($file,'Product');
            $requestData['image'] = $path;
        }

        $new_product = Product::create($requestData);
        $new_product_id = $new_product->id;

         //多個檔案
         if($request->hasFile('multiple_image'))
         {
             $files = $request->file('multiple_image');
             foreach ($files as $file) {
                 //上傳圖片
                 $path = $this->fileUpload($file,'product_imgs');
                 //新增資料進DB
                 $product_img = new ProductImg;
                 $product_img->product_id = $new_product_id;
                 $product_img->image_url = $path;
                 $product_img->save();
             }
         }




        $new_product =  Product::create($requestData);
        $new_product_id = $new_product->id;

        //多個檔案
        $files = $request->file('multiple-image');
        if($request->hasFile('multiple-image'))
        {
            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file,'product');
                //新增資料進DB
                $product_img = new ProductImg;
                $product_img->product_id = $new_product_id;
                $product_img->img_url = $path;
                $product_img->save();

            }
        }


        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        // $item = DB::table('products')->where('id', '=', $id)->first();
        $product = Product::find($product_id);

        $product_types = ProductType::with('products')->get();
<<<<<<< HEAD
        $productimges = productimg::with('multipleimages')->get();
        // dd($product);
        // dd($product_type);

        return view('admin.product.edit',compact('product','product_types','productimges'));
=======

        return view('admin.product.edit',compact('product','product_types'));
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Product::find($id);

        $requestData = $request->all();

        //判斷是否有上傳圖片
        if($request->hasFile('image')) {

            //刪除舊有圖片
            $old_image = $item->image;
            File::delete(public_path().$old_image);

            //上傳新的圖片
            $file = $request->file('image');
            $path = $this->fileUpload($file,'product');

            //將圖片的路徑放入requestData
            $requestData['image'] = $path;

        }

        $item->update($requestData);


        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::find($id);

        $old_image = $item->image;
        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_image);
        }
        $item->delete();

        return redirect('admin/product');
    }

    private function fileUpload($file,$dir){
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if( ! is_dir('upload/')){
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if ( ! is_dir('upload/'.$dir)) {
            mkdir('upload/'.$dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time().md5(rand(100, 200))).'.'.$extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path().'/upload/'.$dir.'/'.$filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/'.$dir.'/'.$filename;
    }
}
