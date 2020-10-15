@extends('layouts.app')

@section('css')

@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">後台</a></li>
        <li class="breadcrumb-item"><a href="/admin/news">資料管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">編輯</li>
    </ol>
</nav>
<form method="POST" action="/admin/news/update/{{$news->id}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">標題 <small class="text-danger">最多20個字</small></label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="title" name="title" value="{{$news->title}}">
    </div>
    <img width="200px" src="{{$news->img_url}}" alt="">
    <div class="form-group">
        <label for="img_url">上傳圖片 <small class="text-danger">圖片寬高比例為4:3</small></label>
        <input type="file" class="form-control-file" id="img_url" name="img_url">
      </div>
    <div class="form-group">
        <label for="sub_title">副標題</label>
        <input type="text" class="form-control" id="exampleInput" aria-describedby="sub_title" name="sub_title" value="{{$news->sub_title}}">
    </div>
    <div class="form-group">
        <label for="content">內容</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content">{{$news->content}}</textarea>
      </div>
    <button type="submit" class="btn btn-primary">送出</button>
</form>
@endsection

@section('js')
    
@endsection
