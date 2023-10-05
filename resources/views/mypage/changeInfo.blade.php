<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員情報変更</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
    </header>
    <main>
        <form action="{{route('postInfo')}}" method="post">
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
                    <input type="text" name="name_sei" value="{{old('name_sei') ?? $first['name_sei']}}" />
                    <label>名</label>
                    <input type="text" name="name_mei" value="{{old('name_mei') ?? $first['name_mei']}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>ニックネーム</label>
                    <input type="text" name="nickname" value="{{old('nickname') ?? $first['nickname']}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    性別
                    <label for="gender1">男性</label>
                    <input type="radio" name="gender" id="gender1" value="1" {{old('gender',$first['gender']) == 1 ? 'checked' : ''}} />
                    <label for="gender2">女性</label>
                    <input type="radio" name="gender" id="gender2" value="2" {{old('gender',$first['gender']) == 2 ? 'checked' : ''}} />
                </p>
            </div>
            <input type="submit" value="確認画面へ" class="toRegisterReview">
        </form>
        <a href="{{route('mypage')}}" class="back_review">マイページに戻る</a>
    </main>
</body>
</html>