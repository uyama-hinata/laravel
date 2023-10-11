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
                商品カテゴリ登録確認
            @elseif(session('previous_page')=='editer')
                商品カテゴリ編集確認
            @endif
        </div>
        
        <a href="{{route('categoryList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{route('exeCategoryRegister')}}" method="POST">
            @csrf

            <div class="form-item">
                <label>商品大カテゴリID:</label>
                <div>
                    @if(session('previous_page')=='register')
                        登録後に自動採番
                    @elseif(session('previous_page')=='editer')
                        {{$input['id']}}
                    @endif
                </div>
            </div>

            <div class="form-item">
                <label>商品大カテゴリ:</label>
                <div>{{$input['category']}}</div>
            </div>

            <div class="form-item">
                <label>商品小カテゴリ:</label>
                <div>{{$input['subcategory1']}}</div>
                <div>{{$input['subcategory2']}}</div>
                <div>{{$input['subcategory3']}}</div>
                <div>{{$input['subcategory4']}}</div>
                <div>{{$input['subcategory5']}}</div>
                <div>{{$input['subcategory6']}}</div>
                <div>{{$input['subcategory7']}}</div>
                <div>{{$input['subcategory8']}}</div>
                <div>{{$input['subcategory9']}}</div>
                <div>{{$input['subcategory10']}}</div>
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