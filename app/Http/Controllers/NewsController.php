<?php

namespace App\Http\Controllers;

use App\news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $news_list = DB::table('news')->orderBy('id','desc')->get();
        $news_list = News::all();

        return view('admin.news.index', compact('news_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // news::create($request->all());

        // $requestData = $request->all();
        // $file_name = $request->file('img_url')->store('','public');
        // $requestData['img_url'] =$file_name;




        // news::create($requestData);

        // $new_news = new news();
        // $new_news->title = $request->title;
        // $new_news->img_url = $request->img_url;
        // $new_news->sub_title = $request->sub_title;
        // $new_news->content = $request->content;
        // $new_news->save();




        $requestData = $request->all();

        //判斷request是否有img_url
        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $path = $this->fileUpload($file, 'news');
            $requestData['img_url'] = $path;
        }

        news::create($requestData);


        return redirect('admin/news');
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
        $news = DB::table('news')->where('id', '=', $id)->first();
        return view('admin.news.edit', compact('news'));
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
        // news::create($request->where('id', '=', $id)->all());

        // DB::table('news')->where('id', '=', $id)->update(
        //     ['title' => $request->title,
        //     'img_url' => $request->img_url,
        //     'sub_title' => $request->sub_title,
        //     'content' => $request->content]
        // );

        $item = news::find($id);

        $requestData = $request->all();

        //判斷是否有上傳圖片
        if ($request->hasFile('img_url')) {

            //刪除舊有圖片
            $old_image = $item->img_url;
            File::delete(public_path() . $old_image);

            //上傳新的圖片
            $file = $request->file('img_url');
            $path = $this->fileUpload($file, 'news');

            //將圖片的路徑放入requestData
            $requestData['img_url'] = $path;
        }

        $item->update($requestData);


        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // news::destroy($id);
        $item = news::find($id);

        $old_image = $item->img_url;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        $item->delete();

        return redirect('admin/news');
    }

    private function fileUpload($file, $dir)
    {
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/')) {
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/' . $dir)) {
            mkdir('upload/' . $dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time() . md5(rand(100, 200))) . '.' . $extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path() . '/upload/' . $dir . '/' . $filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/' . $dir . '/' . $filename;
    }
    public function ajax_upload_img()
    {
        // A list of permitted file extensions
        $allowed = array('png', 'jpg', 'gif', 'zip');
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $allowed)) {
                echo '{"status":"error"}';
                exit;
            }
            $name = strval(time() . md5(rand(100, 200)));
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
            if (!is_dir('summernote/')) {
                mkdir('summernote/');
            }
            //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
            if (!is_dir('upload/img')) {
                mkdir('upload/img');
            }
            $destination = public_path() . '/upload/img/' . $filename; //change this directory
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination);
            echo "/upload/img/" . $filename; //change this URL
        }
        exit;
    }

    public function ajax_delete_img(Request $request)
    {
        if (file_exists(public_path() . $request->file_link)) {
            File::delete(public_path() . $request->file_link);
        }
    }
}
