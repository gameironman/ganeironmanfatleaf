@extends('layouts/nav_footer')

@section('content')

    <section class="banner">
        <div class="swiper-container banner-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img width="100%" src="./images/index/banner/banner_1.JPG" alt="">
                </div>
                <div class="swiper-slide">
                    <img width="100%" src="./images/index/banner/banner_2.JPG" alt="">
                </div>
                <div class="swiper-slide">
                    <img width="100%" src="./images/index/banner/banner_3.JPG" alt="">
                </div>
                <div class="swiper-slide">
                    <img width="100%" src="./images/index/banner/banner_4.JPG" alt="">
                </div>
                <div class="swiper-slide">
                    <img width="100%" src="./images/index/banner/banner_5.JPG" alt="">
                </div>
                <div class="swiper-slide">
                    <img width="100%" src="./images/index/banner/banner_6.JPG" alt="">
                </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next banner-button-next"></div>
            <div class="swiper-button-prev banner-button-prev"></div>
        </div>
    </section>

    <section class="news">
        <div class="container">
            <h2 class="news_title">最新消息</h2>
            <div class="row news_lists">
                {{-- {{$news_list}} --}}

                {{-- foreach迴圈執行套版樣式，new_list變數來自controller，{{}}不太聊解 --}}
                @foreach ($news_list as $value)
                <div class="col-md-4">
                    <div class="news_list">
                    <h3>{{$value->title}}</h3>
                        <h4>{{$value->sub_title}}</h4>
                        <img width="100%" src="{{$value->img_url}}" alt="圖片建議尺寸: 1000 x 567">
                        <p class="news_content">{{$value->content}}</p>
                    <a class="btn btn-success" href="/news_info/{{$value->id}}" role="button">點擊查看更多 &raquo;</a>
                    </div>
                </div>
                @endforeach

        </div>
    </section>


@endsection

