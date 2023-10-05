<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <form action="{{route('exeInfo')}}" method="POST">
            @csrf
            <div class="form-title">会員情報確認画面</div>

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

            <input type="submit" class="toRegisterReview" value="登録完了">
            <input type="submit" name="btn_back" class="back_review" value="前に戻る">
            

        </form>
    </main>
</body>
</html>