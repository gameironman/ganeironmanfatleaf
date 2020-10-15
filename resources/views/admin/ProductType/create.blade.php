@extends('layouts.app')

@section('css')

@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">後台</a></li>
        <li class="breadcrumb-item"><a href="/admin/productType">商品類別管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">新增商品類別</li>
    </ol>
</nav>
<form method="POST" action="/admin/productType" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="type_name">商品類別名稱<small class="text-danger">最多20個字</small></label>
        <input type="text" class="form-control" id="type_name" aria-describedby="type_name" name="type_name" required>
    </div>
    <div class="form-group">
        <label for="sort">商品排序</label>
        <input type="number" class="form-control" min="0" step="1" id="sort" aria-describedby="sort" name="sort" required>
    </div>
    <button type="submit" class="btn btn-primary">送出</button>
</form>

@endsection

@section('js')

@endsection
