<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>メール送信完了</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <div class="main_msg">
            パスワード再設定の案内メールを送信しました 。<br>
            （ まだパスワード再設定は完了しておりません ）<br>
            届きましたメールに記載されている <br>
            『パスワード再設定URL』 をクリックし、<br>
            パスワードの再設定を完了させてください。<br>
        </div>

        <a href="{{route('topLogout')}}" name="toLogout_btn" class="toTop">トップに戻る</a>
    </main>
    
</body>
</html>