<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        @if(session('previous_page')=='register')
            <div class="header_main_msg">商品レビュー登録確認画面</div>
        @elseif(session('previous_page')=='editer')
            <div class="header_main_msg">商品レビュー編集確認画面</div>
        @endif   
    
        <a href="{{route('adminReviewList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <div class="container">
            <div class="confirm-image">
                @if($product && $product->image_1)
                    <img src="{{asset('storage/' . $product->image_1)}}" alt="">
                @endif
                @if($product && $product->image_2)
                    <img src="{{asset('storage/' . $product->image_2)}}" alt="">
                @endif
                @if($product && $product->image_3)
                    <img src="{{asset('storage/' . $product->image_3)}}" alt="">
                @endif
                @if($product && $product->image_4)
                    <img src="{{asset('storage/' . $product->image_4)}}" alt="">
                @endif
            </div>
            <div class="confirm-info">
                商品ID　@if($product){{$product->id}}@endif <br>
                会員　@if($product->user){{$product->user->name_sei}}{{$product->user->name_mei}}@endif <br>
                @if($product){{$product->name}}@endif <br>
                総合評価　@if($product){{$averageEvaluation}}@endif <br>
            </div>
        </div>


        <form action="{{route('exeReviewRegister')}}" method="POST">
            @csrf

            <div class="form-item">
                <label>ID:</label>
                @if(session('previous_page')=='register')
                    <div>登録後に自動採番</div>
                @elseif(session('previous_page')=='editer')
                    <div>{{$input['id']}}</div>
                @endif  
                
            </div>

            <div class="form-item">
                <label>商品評価:</label>
                <div>{{$input['evaluation']}}</div>
                
            </div>

            <div class="form-item">
                <label>商品コメント:</label>
                <div>{{$input['comment']}}</div>
            </div>


            @if(session('previous_page')=='register')
                <input type="submit" class="ToList" value="登録完了">
            @elseif(session('previous_page')=='editer')
                <input type="submit" class="ToList" value="編集完了">
            @endif  
            
            @if(session('previous_page')=='register')
                <input type="submit" name="btn_back" class="btn_back" value="前に戻る">
            @elseif(session('previous_page')=='editer')
                <input type="submit" name="btn_Back" class="btn_back" value="前に戻る">
            @endif
            
        </form>
    </main>
</body>
</html>