@extends('layouts.app')

@section('css')

@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">後台</a></li>
        <li class="breadcrumb-item"><a href="/admin/product">商品管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">編輯</li>
    </ol>
</nav>
{{-- {{$product}} --}}
<form method="POST" action="/admin/product/update/{{$product->id}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">標題 <small class="text-danger">最多20個字</small></label>
        <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="{{$product->name}}">
    </div>
    <img width="200px" src="{{$product->image}}" alt="">
    <div class="form-group">
        <label for="image">上傳圖片 <small class="text-danger">圖片寬高比例為4:3</small></label>
        <input type="file" class="form-control-file" id="image" name="image">
      </div>
<<<<<<< HEAD
      <div>
        {{$productimges}}
      </div>
=======
    <div>
        原本的多張圖片
        @foreach ($product->product_imgs as $product_img)
        <img height="200" src="{{$product_img->img_url}}" alt="">
        @endforeach
    </div>
    {{-- {{$product->product_imgs}} --}}
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
    <div class="form-group">
        <label for="product_type_id">商品類別</label>
        <select class="form-control" id="product_type_id" name="product_type_id">
          @foreach ($product_types as $product_type)
          <option value="{{$product_type->id}}" @if($product_type->id == $product->product_type_id) selected @endif>{{$product_type->type_name}}</option>
          @endforeach
          {{-- <option value="1">飯類</option>
          <option value="2">麵類</option>
          <option value="3">飲品</option>
          <option value="4">湯類</option> --}}

          {{-- @if($product_type->id == $porduct->product_type_id) selected @endif --}}
        </select>
    </div>
    <div class="form-group">
        <label for="price">價格</label>
        <input type="text" class="form-control" id="price" aria-describedby="price" name="price" value="{{$product->price}}">
    </div>
    <div class="form-group">
        <label for="info">介紹</label>
        <textarea class="form-control" id="info" rows="3" name="info">{{$product->info}}</textarea>
      </div>
    <button type="submit" class="btn btn-primary">送出</button>
</form>
@endsection

@section('js')

@endsection
