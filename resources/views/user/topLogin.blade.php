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
            @if(session('name_sei') && session('name_mei'))
            {{session('name_sei')}} {{session('name_mei')}}
            @elseif($user)
            {{$user->name_sei}} {{$user->name_mei}}
            @endif
            様</div>
        <a href="{{route('topLogout')}}" name="toLogout_btn">ログアウト</a>
    </header>
    
</body>
</html>