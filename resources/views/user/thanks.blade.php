<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>完了画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <form action="{{ route('postThanks') }}" method="post">
            @csrf
            <div class="form-title">会員登録完了</div>
            <div class="thank_msg"><p>会員登録が完了しました。</p></div>
            <input type="submit" name="btn_back" class="btn_back" value="トップに戻る">
        </form>
    </main>
</body>
</html>