<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>レビュー詳細</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <a href="{{route('adminReviewList')}}" class="toTop_btn">一覧へ戻る</a>
    </header>
    <main>
        <div class="container">
            <div class="confirm-image">
                @if($review->product && $review->product->image_1)
                    <img src="{{asset('storage/' . $review->product->image_1)}}" alt="">
                @endif
                @if($review->product && $review->product->image_2)
                    <img src="{{asset('storage/' . $review->product->image_2)}}" alt="">
                @endif
                @if($review->product && $review->product->image_3)
                    <img src="{{asset('storage/' . $review->product->image_3)}}" alt="">
                @endif
                @if($review->product && $review->product->image_4)
                    <img src="{{asset('storage/' . $review->product->image_4)}}" alt="">
                @endif
            </div>
            <div class="confirm-info">
                商品ID　@if($review->product){{$review->product->id}}@endif <br>
                会員　@if($review->product->user){{$review->product->user->name_sei}}{{$review->product->user->name_mei}}@endif <br>
                @if($review->product){{$review->product->name}}@endif <br>
                総合評価　@if($review->product)@for ($i=0;$i<$averageEvaluation;$i++)★ @endfor{{$averageEvaluation}}@endif <br>
            </div>
        </div>


        <form action="{{route('exeDeleteReview',['id'=>$review->id])}}" method="POST">
            @csrf

            <div class="form-item">
                <label>ID:</label>
                <div>{{$review['id']}}</div>
            </div>

            <div class="form-item">
                <label>商品評価:</label>
                <div>
                    {{$review['evaluation']}}
                </div>
                
            </div>

            <div class="form-item">
                <label>商品コメント:</label>
                <div>{{$review['comment']}}</div>
            </div>


            <div class="btn_group">
                <a href="{{route('adminEditerReview',['id'=>$review->id])}}" class="toEditer_btn" >編集</a>
                <input type="submit" class="delete_btn" value="削除"/>
            </div>

            
        </form>
    </main>
</body>
</html>