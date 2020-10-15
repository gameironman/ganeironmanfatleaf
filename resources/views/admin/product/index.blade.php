@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">後台</a></li>
            <li class="breadcrumb-item active" aria-current="page">商品管理</li>
        </ol>

        <a href="/admin/product/create" class="btn btn-success mb-3">新增最新商品</a>
    </nav>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名稱</th>
                <th>圖片</th>
                <th>總類</th>
                <th>價格</th>
                <th>介紹</th>
                <th>上市時間</th>
                <th width="120px">編輯</th>
            </tr>
        </thead>
        <tbody>
            {{-- {{$product_types->type_name}} --}}
            @foreach ($item_list as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td><img width="200px" src="{{$value->image}}" alt=""></td>
                {{-- <td><img width="200px" src="{{asset('/storage/'.$value->img_url)}}" alt=""></td> --}}

                {{-- <td>{{$value->product_type_id}}</td> --}}
                <td>{{$value->product_type->type_name}}</td>
                <td>{{$value->price}}</td>
                <td>{{$value->info}}</td>
                <td>{{$value->date}}</td>

                <td>
                    <a href="/admin/product/edit/{{$value->id}}" class="btn btn-sm btn-info">編輯</a>
                    <button class="btn btn-sm btn-danger btn-delete" data-newsid="{{$value->id}}">刪除</button>
                    {{-- <form id="logout-form-{{$product_type->id}}" action="/admin/productType/{{$product_type->id}}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
        public function ajax_upload_img()
{
// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');
if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if(!in_array(strtolower($extension), $allowed)){
        echo '{"status":"error"}';
        exit;
    }
    $name = strval(time().md5(rand(100, 200)));
    $ext = explode('.', $_FILES['file']['name']);
    $filename = $name . '.' . $ext[1];
    //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
    if( ! is_dir('upload/')){
        mkdir('upload/');
    }
    //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
    if ( ! is_dir('upload/img')) {
        mkdir('upload/img');
    }
    $destination = public_path().'/upload/img/'. $filename; //change this directory
    $location = $_FILES["file"]["tmp_name"];
    move_uploaded_file($location, $destination);
    echo "/upload/img/".$filename;//change this URL
}
exit;
}

public function ajax_delete_img(Request $request){
if(file_exists(public_path().$request->file_link)){
    File::delete(public_path().$request->file_link);
}
}
    } );
</script>


@endsection
