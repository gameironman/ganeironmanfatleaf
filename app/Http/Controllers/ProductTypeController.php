<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 用ORM抓取MODEL->ProductType的資料
        $product_types = ProductType::all();

        return view('admin.productType.index',compact('product_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //此function用來顯示create頁面
        return view('admin.productType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create頁面的資料會回傳過來這個function，接取資料並寫入(創造)到MODEL->ProductType裡面
        ProductType::create($request->all());

        return redirect()->route('productType.index');

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
    public function edit($id)
    {
        //找到MODEL->ProductType位於$id的資料
        $product_type = ProductType::find($id);

        // dd($product_type);

        return view('admin.productType.edit',compact('product_type'));
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
        //接取edit頁面裡發送的資料並寫入(創造)到MODEL->ProductType的$id(商品類別)位置的那筆資料
        $product_type = ProductType::find($id);

        $product_type->update($request->all());

        return redirect()->route('productType.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //刪除MODEL->ProductType位於$id(商品類別)的資料，並把MODEL->Product裡面product_type_id=$id的資料一併刪除
        // dd($id);
        ProductType::destroy($id);
        Product::where('product_type_id',$id)->delete();

        return redirect()->route('productType.index');
    }
}
