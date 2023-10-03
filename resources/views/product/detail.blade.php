<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>詳細画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品詳細</div>
        @auth
            <a href="{{route('topLogin')}}">トップに戻る</a>
        @endauth
        @guest
            <a href="{{route('topLogout')}}">トップに戻る</a>
        @endguest
    </header>
    <main>
        <div class="detail_category">
            {{$product->product_category->name}} ＞{{$product->product_subcategory->name}}
        </div>
        <div class="detail_name">
            {{$product->name}}
        </div>
        <div class="detail_date">
            更新日：
            {{$product->updated_at->format('Y年n月j日')}}
        </div>
        <div class="detail_image">
            @if(!empty($product->image_1))
                <img class="show_image" src="{{asset('storage/' . $product->image_1)}}">
            @endif
            @if(!empty($product->image_2))
                <img class="show_image" src="{{asset('storage/' . $product->image_2)}}">
            @endif
            @if(!empty($product->image_3))
                <img class="show_image" src="{{asset('storage/' . $product->image_3)}}">
            @endif
            @if(!empty($product->image_4))
                <img class="show_image" src="{{asset('storage/' . $product->image_4)}}">
            @endif
        </div>
        <div class="detail_content">
            ■商品説明<br>
            {{$product->product_content}}
        </div>
        <div class="detail_review">
            ■商品レビュー<br>
            総合評価 : 
            @if(empty($averageEvaluation->evaluations))
            @elseif($averageEvaluation->evaluations==1)★
            @elseif($averageEvaluation->evaluations==2)★★
            @elseif($averageEvaluation->evaluations==3)★★★
            @elseif($averageEvaluation->evaluations==4)★★★★
            @elseif($averageEvaluation->evaluations==5)★★★★★
            @endif
            {{$averageEvaluation->evaluations ?? '未評価'}}
        </div>
        <div class="toReviewList"><a class="toReviewList" href="{{route('reviewList')}}">＞＞レビューを見る</a></div>

        @auth
        <a href="{{route('reviewRegister',['id'=>$product->id])}}" class="toRegisterReview">この商品についてのレビューを登録</a>
        @endauth
        {{-- それぞれ元居た場所に --}}
        <a href="{{route('productList',['page'=>session('previous_page')])}}" name="toList_btn" class="toTop">一覧に戻る</a>
        
    </main>
</body>
</html>