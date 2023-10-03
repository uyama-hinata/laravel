<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>レビュー登録画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品レビュー登録</div>
        @auth
            <a href="{{route('topLogin')}}">トップに戻る</a>
        @endauth
        @guest
            <a href="{{route('topLogout')}}">トップに戻る</a>
        @endguest
    </header>
    <main>
        <div class="show-item">
            <div class="show-images">
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
            <div class="show-info">
                <div class="show_name">{{$product->name}}</div>
                <div class="show_review">
                    総合評価
                    @if(empty($averageEvaluation->evaluations))
                        @elseif($averageEvaluation->evaluations==1)★
                        @elseif($averageEvaluation->evaluations==2)★★
                        @elseif($averageEvaluation->evaluations==3)★★★
                        @elseif($averageEvaluation->evaluations==4)★★★★
                        @elseif($averageEvaluation->evaluations==5)★★★★★
                    @endif
                    {{$averageEvaluation->evaluations}}
                </div>
            </div>
        </div>
        
        <form action="{{route('postReview')}}" method="post">
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
                        <option value="1" @if(old('evaluation')=='1')selected @endif>1</option>
                        <option value="2" @if(old('evaluation')=='2')selected @endif>2</option>
                        <option value="3" @if(old('evaluation')=='3')selected @endif>3</option>
                        <option value="4" @if(old('evaluation')=='4')selected @endif>4</option>
                        <option value="5" @if(old('evaluation')=='5')selected @endif>5</option>
                    </select>
                </div>
                <div class="register-comment">
                    商品コメント
                    <textarea name="comment" id="register-comment" cols="40" rows="10" >{{old('comment')}}</textarea>
                </div>
            </div>
        
            <input  type="submit" class="toRegisterReview" value="商品レビュー登録確認" id="btn_next">
        </form>

        <a href="{{route('productDetail',['id'=>$product->id])}}" class="back_review">商品詳細に戻る</a> 
    </main>
</body>
</html>