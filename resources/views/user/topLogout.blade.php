<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>トップ画面（ログアウト）</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <a href="{{route('productList')}}" name="toList_btn">商品一覧</a>
        <a href="{{route('userRegister')}}" name="toRegist_btn">新規会員登録</a>
        <a href="{{route('Login')}}" name="toLogin_btn">ログイン</a>
    </header>
</body>
</html>