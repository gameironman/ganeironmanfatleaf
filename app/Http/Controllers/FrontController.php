<?php

namespace App\Http\Controllers;

use App\Place;
use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        // $user = DB::table('user')->get();
        $news_list = DB::table('news')->orderBy('id','desc')->take(3)->get();
        //新增變數new_list,用DB索引migrations->table->news裡的變數
        //orderBy('誰','方法')--排序 take(幾個)--取幾個 get()--取值


        return view('front.index',compact('news_list'));
        //回傳 view('位址',??)
    }

    public function contact_us()
    {
        return view('front.contact_us');
    }

    public function news()
    {
        $news_list = DB::table('news')->orderBy('id','desc')->paginate(6);
        // dd($news_list);
        return view('front.news',compact('news_list'));
    }

    public function news_info($news_id)
    {
        $news = DB::table('news')->where('id', '=', $news_id)->first();

        return view('front.news_info',compact('news'));
    }

    public function animals()
    {
        $news_list = DB::table('animals')->orderBy('id','desc')->paginate(6);

        return view('front.animals',compact('news_list'));
    }

    public function animals_info($animals_id) //變數$animals_id用來儲存網址抓到的值
    {
        $news = DB::table('animals')->where('id', '=', $animals_id)->first();
        // dd($animals_id);
        return view('front.animals_info',compact('news'));

    }

    public function product() //變數$product用來儲存網址抓到的值
    {
        // $item_list = DB::table('products')->orderBy('id','desc')->paginate(6);
        // dd($animals_id);

        $product_types = ProductType::with('products')->get();
        // dd($product_types);
        return view('front.product',compact('product_types'));

    }

    public function product_detail($product_id) //變數$product用來儲存網址抓到的值
    {
        $product = Product::find($product_id);
        // dd($product_types);
        return view('front.product_detail',compact('product'));

    }

    // public function animals_info(Request $request) //舊規格取值寫法
    // {
    //     dd($request->all());
    //     dd($request->animals_info());
    // }

    public function store_contact(Request $request)
    {
        // dd($hello->all());

        // DB::table('place')->insert(
        //     ['email' => $hello->email,
        //      'location' => $hello->location,
        //      'file' => '',
        //      'place_name' => $hello->place_name,
        //      'description' => $hello->description ]
        // );

        Place::create($request->all()); //Place要注意有沒有USE(看最上面)，因為是從model取變數
        return 'GooD,上傳成功';
    }
}
