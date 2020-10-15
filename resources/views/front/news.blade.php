@extends('layouts/nav_footer')


@section('css')
<link rel="stylesheet" href="/css/news.css">
@endsection

@section('content')

    <section class="news">
        <div class="container">
            <h2 class="news_title">最新消息</h2>

            <div class="row news_lists">
                @foreach ($news_list as $value)
                <div class="col-md-4">
                    <div class="news_list">
                        <h3>{{$value->title}}</h3>
                        <h4>{{$value->sub_title}}</h4>
                        <img width="100%" src="{{$value->img_url}}" alt="圖片建議尺寸: 1000 x 567">
                        <p class="news_content">{{$value->content}}</p>
                        <a class="btn btn-success" href="/news_info/{{$value->id}}" role="button">點擊查看更多</a>
                    </div>
                </div>
                @endforeach
            </div>


            {{-- paginate套件功能，直接長出分業按鈕 --}}
            {{ $news_list->links('pagination::bootstrap-4') }}

        </div>
    </section>


@endsection
