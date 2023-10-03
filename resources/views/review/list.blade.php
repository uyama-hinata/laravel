<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>レビュー一覧画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品レビュー一覧</div>
        @auth
            <a href="{{route('topLogin')}}">トップに戻る</a>
        @endauth
        @guest
            <a href="{{route('topLogout')}}">トップに戻る</a>
        @endguest
    </header>
    <main>
        <div class="show">
            <div class="show-item">
                <div class="show-images">
                    @if(session('product_image_1'))
                        <img class="show_image" src="{{asset('storage/' . session('product_image_1'))}}">
                    @elseif(session('image_1'))
                        <img class="show_image" src="{{asset('storage/' . session('image_1'))}}">
                    @endif
                    @if(session('product_image_2'))
                        <img class="show_image" src="{{asset('storage/' . session('product_image_2'))}}">
                    @elseif(session('image_2'))
                        <img class="show_image" src="{{asset('storage/' . session('image_2'))}}">
                    @endif
                    @if(session('product_image_3'))
                        <img class="show_image" src="{{asset('storage/' . session('product_image_3'))}}">
                    @elseif(session('image_3'))
                        <img class="show_image" src="{{asset('storage/' . session('image_3'))}}">
                    @endif
                    @if(session('product_image_4'))
                        <img class="show_image" src="{{asset('storage/' . session('product_image_4'))}}">
                    @elseif(session('image_4'))
                        <img class="show_image" src="{{asset('storage/' . session('image_4'))}}">
                    @endif
                </div>
                <div class="show-info">
                    <div class="show_name">
                        @if(session('product_name'))
                            {{session('product_name')}}
                        @elseif(session('name'))
                            {{session('name')}}
                        @endif
                    </div>
                    <div class="show_review">
                        @if(empty(session('product_review')))
                        @elseif(session('product_review')==1)★
                        @elseif(session('product_review')==2)★★
                        @elseif(session('product_review')==3)★★★
                        @elseif(session('product_review')==4)★★★★
                        @elseif(session('product_review')==5)★★★★★
                        @endif
                        {{session('product_review') ?? '未評価'}}
                    </div>
                </div>
            </div>
        </div>
        <div class="show_reviews">
            @foreach($reviews as $review)
                <div class="review_item">
                    <div class="review_header">
                        <div class="show_nickname">{{$review->user->nickname}}さん</div>
                        <div class="show_evaluatin">
                            @if(empty($review->evaluation))
                            @elseif($review->evaluation==1)★
                            @elseif($review->evaluation==2)★★
                            @elseif($review->evaluation==3)★★★
                            @elseif($review->evaluation==4)★★★★
                            @elseif($review->evaluation==5)★★★★★
                            @endif
                            {{$review->evaluation}}
                        </div>
                    </div>
                    <div class="show_comment">商品コメント：{{$review->comment}}</div>
                </div>
            @endforeach
        </div>
        <div class="page">{{$reviews->links('vendor.pagination.bootstrap-5')}}</div>

        <a href="{{route('productDetail',['id'=>session('product_id')])}}" name="toLogin_btn" class="toTop">商品詳細に戻る</a>
        
    </main>
</body>
</html>