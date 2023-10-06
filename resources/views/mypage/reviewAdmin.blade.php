<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品レビュー管理</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品レビュー管理</div>
        
        <a href="{{route('topLogin')}}">トップに戻る</a>
        
    </header>
    <main>
        <div class="show">
            @foreach($reviews as $review)
                <div class="show-item">
                    <div class="show-images">
                        @if(!empty($review->product->image_1))
                            <img class="show_image" src="{{asset('storage/' . $review->product->image_1)}}">
                        @endif
                        @if(!empty($review->product->image_2))
                            <img class="show_image" src="{{asset('storage/' . $review->product->image_2)}}">
                        @endif
                        @if(!empty($review->product->image_3))
                            <img class="show_image" src="{{asset('storage/' . $review->product->image_3)}}">
                        @endif
                        @if(!empty($review->product->image_4))
                            <img class="show_image" src="{{asset('storage/' . $review->product->image_4)}}">
                        @endif
                    </div>
                    <div class="show-info">
                        <div class="show-categories">
                            <div class="show_category">{{$review->product->product_category->name}}</div>＞
                            <div class="show_subcategory">{{$review->product->product_subcategory->name}}</div>
                        </div>
                        <div class="show_review">
                            @if($review->evaluation==1)★
                            @elseif($review->evaluation==2)★★
                            @elseif($review->evaluation==3)★★★
                            @elseif($review->evaluation==4)★★★★
                            @elseif($review->evaluation==5)★★★★★
                            @endif
                        </div>
                        <div class="show_comment">
                            {{mb_strimwidth($review->comment,0,36,'...')}}
                        </div>
                        <div class="editBtnGroup">
                            <a href="{{route('reviewEdit',['id'=>$review->id])}}" class="edit_btn">編集</a>
                            <a href="{{route('reviewDelete',['id'=>$review->id])}}"class="delete_btn">削除</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="page">{{$reviews->links('vendor.pagination.bootstrap-5')}}</div>

        <a href="{{route('mypage')}}" class="back_review">マイページに戻る</a>
        
    </main>
</body>
</html>