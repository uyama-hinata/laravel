<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員情報登録</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <form action="{{ route('postData') }}" method="POST">
            @csrf
            <div class="form-title">
                会員情報登録
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
                    氏名
                    <label >姓</label>
                    <input type="text" name="name_sei" value="{{old('name_sei')}}"/>
                    <label>名</label>
                    <input type="text" name="name_mei" value="{{old('name_mei')}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>ニックネーム</label>
                    <input type="text" name="nickname" value="{{old('nickname')}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    性別
                    <label for="gender1">男性</label>
                    <input type="radio" name="gender" id="gender1" value="1" {{old('gender') == 1 ? 'checked' : ''}} />
                    <label for="gender2">女性</label>
                    <input type="radio" name="gender" id="gender2" value="2" {{old('gender') == 2 ? 'checked' : ''}} />
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>パスワード</label>
                    <input type="password" name="password" value=""/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label> パスワード確認</label>
                    <input type="password" name="password_confirmation" value=""/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>メールアドレス</label>
                    <input type="text" name="email" value="{{old('email')}}"/>
                </p>
            </div>
            
            <input type="submit" class="btn_next" value="確認画面"/>
            <a href="{{route('topLogout')}}" name="toLogout_btn" class="toTop">トップに戻る</a>

        </form>
    </main>
</body>
</html>