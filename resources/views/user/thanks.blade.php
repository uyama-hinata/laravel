<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>完了画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <div class="form-title">会員登録完了</div>
        <div class="thank_msg"><p>会員登録が完了しました。</p></div>
        <a href="{{route('topLogin')}}" name="toLogin_btn" class="toTop">トップに戻る</a>
    </main>
</body>
</html>