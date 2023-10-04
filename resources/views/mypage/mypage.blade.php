<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">マイページ</div>
        
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <a href="{{route('topLogin')}}">トップに戻る</a>
            <input type="submit" value="ログアウト" class="logout-button"/>
        </form>
    </header>
    <main>
        <div class="mepage_show">
            <div class="mypage_name">{{$user->name_sei}}{{$user->name_mei}}</div>
            <div class="mypage_nickname">{{$user->nickname}}</div>
            <div class="mypage_gender">@if($user->gender==1)男性@elseif($user->gender==2)女性@endif</div>
            <div class="mypage_password">セキュリティのため非表示</div>
            <div class="mypage_email">{{$user->email}}</div>
        </div>
        <a href="{{route('delete')}}" class="back_review">退会</a>
    </main>
</body>
</html>