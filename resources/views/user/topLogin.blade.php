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
        <form action="{{route('logout')}}" method="POST">
            @csrf
        <input type="submit" value="ログアウト"/>
        </form>
    </header>
    
</body>
</html>