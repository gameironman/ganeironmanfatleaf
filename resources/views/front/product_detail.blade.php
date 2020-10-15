@extends('layouts/nav_footer')

@section('css')
<link rel="stylesheet" href="/css/news_info.css">
@endsection

@section('content')

        <section class="news_info">
            <div class="container">
                <h2 class="info_title">{{$product->name}}</h2>
                <div class="row">
                    <div class="col-12 my-3 my-md-0 col-md-6">
                        <div class="image_box h-100">
                            <a href="{{$product->image}}" data-lightbox="image-1" data-title="My caption">
                                <img width="100%" src="{{$product->image}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 my-3 my-md-0 col-md-6">
                        <h3>商品類別:{{$product->product_type->type_name}}</h3>
                        <h3>價格:{{$product->price}}</h3>
                        <div class="info_content">
                            {{$product->info}}
                        </div>

                    </div>
                </div>
            </div>
        </section>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection

