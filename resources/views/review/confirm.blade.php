<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>レビュー確認画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品レビュー登録確認</div>
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
                @if(session('product_image_1'))
                    <img class="show_image" src="{{asset('storage/' . session('product_image_1'))}}">
                @endif
                @if(session('product_image_2'))
                    <img class="show_image" src="{{asset('storage/' . session('product_image_2'))}}">
                @endif
                @if(session('product_image_3'))
                    <img class="show_image" src="{{asset('storage/' . session('product_image_3'))}}">
                @endif
                @if(session('product_image_4'))
                    <img class="show_image" src="{{asset('storage/' . session('product_image_4'))}}">
                @endif
            </div>
            <div class="show-info">
                <div class="show_name">{{session('product_name')}}</div>
                <div class="show_review">
                    総合評価
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
        
        <form action="{{route('exeReview')}}" method="post">
            @csrf
            
            <div class="confirm-review-erea">
                <div class="confirm-evaluation">
                    商品評価：
                    <div class="confirm-evaluation">{{$input['evaluation']}}</div>
                    <input type="hidden" value="{{$input['evaluation']}}" name="evaluation">   
                    
                </div>
                <div class="confirm-comment">
                    商品コメント：
                    <div class="confirm-comment">{{$input['comment']}}</div>
                    <input type="hidden" value="{{$input['comment']}}" name="comment">
                </div>
            </div>
        
            <input  type="submit" class="toRegisterReview" value="登録する" id="btn_next">
            <input type="submit" name="btn_back" class="back_review" value="前に戻る">
        </form>
    </main>
</body>
</html>