<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>メールアドレス変更</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
    </header>
    <main>
        <form action="{{route('sendChangeEmail')}}" method="post">
            @csrf
            <div class="form-title">
                メールアドレス変更
            </div>

            <div class="errors">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                @endif
            </div>

            <div class="form-item">
                <p>
                    <label>現在のメールアドレス</label>
                    {{$userEmail}}
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>変更後のメールアドレス</label>
                    <input type="text" name="email" value="{{old('email')}}"/>
                </p>
            </div>

            <input type="submit" value="認証メール送信" class="toRegisterReview">
        </form>
        <a href="{{route('mypage')}}" class="back_review">マイページに戻る</a>
    </main>
</body>
</html>