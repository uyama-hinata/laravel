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
            <div class="form-title">会員情報登録</div>
            <div class="form-item">
                <p>
                    氏名
                    <label >姓</label>
                    <input type="text" name="name_sei" value="{{old('name_sei')}}"/>
                    <label>名</label>
                    <input type="text" name="name_mei" value="{{old('name_mei')}}"/>
                </p>

                @if($errors->has('name_sei'))
                    <div class="errors">
                        {{$errors->first('name_sei')}}
                    </div>
                @endif
                @if($errors->has('name_mei'))
                    <div class="errors">
                        {{$errors->first('name_mei')}}
                    </div>
                @endif
            </div>

            <div class="form-item">
                <p>
                    <label>ニックネーム</label>
                    <input type="text" name="nickname" value="{{old('nickname')}}"/>
                </p>

                @if($errors->has('nickname'))
                    <div class="errors">
                        {{$errors->first('nickname')}}
                    </div>
                @endif
            </div>

            <div class="form-item">
                <p>
                    性別
                    <label for="gender1">男性</label>
                    <input type="radio" name="gender" id="gender1" value="1" {{old('gender') == 1 ? 'checked' : ''}} />
                    <label for="gender2">女性</label>
                    <input type="radio" name="gender" id="gender2" value="2" {{old('gender') == 2 ? 'checked' : ''}} />
                </p>

                @if($errors->has('gender'))
                    <div class="errors">
                        {{$errors->first('gender')}}
                    </div>
                @endif
            </div>

            <div class="form-item">
                <p>
                    <label>パスワード</label>
                    <input type="password" name="password" value="{{old('password')}}"/>
                </p>

                @if($errors->has('password'))
                <div class="errors">
                    {{$errors->first('password')}}
                </div>
            @endif
            </div>

            <div class="form-item">
                <p>
                    <label> パスワード確認</label>
                    <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>メールアドレス</label>
                    <input type="text" name="email" value="{{old('email')}}"/>
                </p>

                @if($errors->has('email'))
                    <div class="errors">
                        {{$errors->first('email')}}
                    </div>
                @endif
            </div>
            
            <input type="submit" class="btn_next" value="確認画面"/>

        </form>
    </main>
</body>
</html>