@extends('layouts/nav_footer')


@section('css')
<link rel="stylesheet" href="/css/news.css">
@endsection

@section('content')

    <section class="news">
        <div class="container">
            <h2 class="news_title">美味商品</h2>
            <div class="row news_lists">
                {{-- {{$product_types}} --}}
                @foreach ($product_types as $product_type)
                <div class="col-12 mb-3">
                    <h1>{{$product_type->type_name}}</h1>
                        <div class="row">
                            @foreach ($product_type->products as $product)
                            <div class="col-mb-4 mx-1 border">
                                <div class="new_list">
                                    <h3>{{$product->name}}</h3>
                                    <img width="300px" src="{{$product->image}}" alt="圖片建議尺寸: 1000 x 567">
                                    <p class="news_content">價格:{{$product->price}}</p>
                                    <p>{{$product->info}}</p>
                                    <a class="btn btn-success" href="/product_detail/{{$product->id}}" role="button">點擊查看更多</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


@endsection
