<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>レビュー編集画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品レビュー編集</div>
        
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
        
        <form action="{{route('postEdit')}}" method="post">
            @csrf

            <div class="errors">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                @endif
            </div>
            
            <div class="register-review-erea">
                <div class="register-evaluation">
                    商品評価
                    <select class="register-evaluation" name="evaluation" id="register-evaluation" >
                        <option value=""></option>
                        <option value="1" @if(old('evaluation', $first['evaluation']) == 1) selected @endif>1</option>
                        <option value="2" @if(old('evaluation',$first['evaluation']) == 2)selected @endif>2</option>
                        <option value="3" @if(old('evaluation',$first['evaluation']) == 3)selected @endif>3</option>
                        <option value="4" @if(old('evaluation',$first['evaluation']) == 4)selected @endif>4</option>
                        <option value="5" @if(old('evaluation',$first['evaluation']) == 5)selected @endif>5</option>
                    </select>
                </div>
                <div class="register-comment">
                    商品コメント
                    <textarea name="comment" id="register-comment" cols="40" rows="10" >{{old('comment')?? $first['comment']}}</textarea>
                </div>
            </div>
        
            <input  type="submit" class="toRegisterReview" value="商品レビュー編集確認" id="btn_next">
        </form>

        <a href="{{route('reviewAdmin')}}" class="back_review">レビュー管理に戻る</a> 
    </main>
</body>
</html>