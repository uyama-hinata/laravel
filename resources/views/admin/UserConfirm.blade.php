<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_main_msg">
            @if(session('previous_page')=='register')
                会員登録
            @elseif(session('previous_page')=='editer')
                会員編集
            @endif
        </div>
        
        <a href="{{route('userList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{route('exeUserRegister')}}" method="POST">
            @csrf

            <div class="form-item">
                <label>ID:</label>
                <div>
                    @if(session('previous_page')=='register')
                        登録後に自動採番
                    @elseif(session('previous_page')=='editer')
                        {{$input['id']}}
                    @endif
                </div>
            </div>

            <div class="form-item">
                <label>氏名:</label>
                <div>{{$input['name_sei']}} {{$input['name_mei']}}</div>
            </div>

            <div class="form-item">
                <label>ニックネーム:</label>
                <div>{{$input['nickname']}}</div>
            </div>

            <div class="form-item">
                <label>性別:</label>
                <div>
                    @if($input['gender']==1)
                    {{ config('master.gender.1');}}
                    @elseif($input['gender']==2)
                    {{config('master.gender.2');}}
                    @endif
                </div>
            </div>

            <div class="form-item">
                <label>パスワード:</label>
                <div>セキュリティのため非表示</div>
                <input type="hidden" name="password" value="{{$input['password']}}">
            </div>

            <div class="form-item">
                <label>メールアドレス:</label>
                <div>{{$input['email']}}</div>
            </div>

            @if(session('previous_page')=='register')
                <input type="submit" class="ToList" value="登録完了">
            @elseif(session('previous_page')=='editer')
                <input type="submit" class="ToList" value="編集完了">
            @endif

            @if(session('previous_page')=='register')
                <input type="submit" name="btn_back" class="btn_back" value="前に戻る">
            @elseif(session('previous_page')=='editer')
                <input type="submit" name="btn_Back" class="btn_back" value="前に戻る">
            @endif
            
            

        </form>
    </main>
</body>
</html>