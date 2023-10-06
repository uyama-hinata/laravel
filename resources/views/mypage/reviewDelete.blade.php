<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>レビュー削除画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品レビュー削除確認</div>
        
        <a href="{{route('topLogin')}}">トップに戻る</a>
        
    </header>
    <main>
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
                <div class="show_name">{{$review->product->name}}</div>
                <div class="show_review">
                    総合評価
                    @if($averageEvaluation==1)★
                    @elseif($averageEvaluation==2)★★
                    @elseif($averageEvaluation==3)★★★
                    @elseif($averageEvaluation==4)★★★★
                    @elseif($averageEvaluation==5)★★★★★
                    @endif
                    {{$averageEvaluation}}
                </div>
            </div>
        </div>
        
        
            
        <div class="register-review-erea">
            <div class="confirm-review-erea">
                <div class="confirm-evaluation">
                    商品評価：
                    <div class="confirm-evaluation">{{$first['evaluation']}}</div>  
                </div>
                <div class="confirm-comment">
                    商品コメント：
                    <div class="confirm-comment">{{$first['comment']}}</div>
                </div>
            </div>
        </div>
    
        <form action="{{route('exeReviewDelete',['id'=>$review->id])}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$review->id}}">
            <input type="submit" value="レビューを削除する" class="toRegisterReview" >
        </form>

        <a href="{{route('reviewAdmin')}}" class="back_review">レビュー管理に戻る</a> 
    </main>
</body>
</html>