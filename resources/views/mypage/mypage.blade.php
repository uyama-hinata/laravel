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
            <div class="mypage_name">
                <span>氏名</span>
                {{$user->name_sei}}{{$user->name_mei}}
            </div>
            <div class="mypage_nickname">
                <span>ニックネーム</span>
                {{$user->nickname}}
            </div>
            <div class="mypage_gender">
                <span>性別</span>
                @if($user->gender==1)男性@elseif($user->gender==2)女性@endif
                <a href="{{route('changeInfo')}}" class="change_btn">会員情報変更＞</a>
            </div>
            <div class="mypage_password">
                <span>パスワード</span>
                セキュリティのため非表示
                <a href="{{route('changePass')}}" class="change_btn">パスワード変更＞</a>
            </div>
            <div class="mypage_email">
                <span>メールアドレス</span>
                {{$user->email}}
                <a href="{{route('changeEmail')}}" class="change_btn">メールアドレス変更＞</a>
            </div>
        </div>
        <a href="{{route('delete')}}" class="back_review">退会</a>
    </main>
</body>
</html>