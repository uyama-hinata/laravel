<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>トップ画面（ログイン）</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg">
            ようこそ　
            @if($user)
            {{$user->name_sei}} {{$user->name_mei}}
            @endif
            様

            <div class="status">
                @if (session('status'))
                {{session('status')}}
                @endif
            </div>
            
        </div>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <a href="{{route('productList')}}" name="toList_btn">商品一覧</a>
            <a href="{{route('productRegister')}}" name="toRegist_btn">新規商品登録</a>
            <a href="{{route('mypage')}}" name="toList_btn">マイページ</a>
            <input type="submit" value="ログアウト" class="logout-button"/>
        </form>
    </header>
    
</body>
</html>