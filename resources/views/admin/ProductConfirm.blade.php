<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        @if(session('previous_page')=='register')
            <div class="header_main_msg">商品登録確認画面</div>
        @elseif(session('previous_page')=='editer')
            <div class="header_main_msg">商品編集確認画面</div>
        @endif   
    
        <a href="{{route('adminProductList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{route('exeProductRegister')}}" method="POST">
            @csrf

            <div class="form-item">
                <label>ID:</label>
                @if(session('previous_page')=='register')
                    <div>登録後に自動採番</div>
                @elseif(session('previous_page')=='editer')
                    <div>{{$input['id']}}</div>
                @endif  
                
            </div>

            <div class="form-item">
                <label>会員:</label>
                <div>{{$input['user_name']}}</div>
                
            </div>

            <div class="form-item">
                <label>商品名:</label>
                <div>{{$input['product_name']}}</div>
            </div>

            <div class="form-item">
                <label>商品カテゴリ:</label>
                <div>{{$input['category_name']}}＞{{$input['subcategory_name']}}</div>
            
            </div>

            <div class="form-item image">
                <label>商品写真:</label>
                <div class="center">
                    <label>写真１</label>
                        <div class="center"><img src="{{session('uploaded_paths.path_1') ? asset('storage/' . session('uploaded_paths.path_1')) : ''}}" alt=""></div>
                </div>

                <div class="center">
                    <label>写真２</label>
                        <div class="center"><img src="{{session('uploaded_paths.path_2') ? asset('storage/' . session('uploaded_paths.path_2')) : ''}}" alt=""></div>
                </div>

                <div class="center">
                    <label>写真３</label>
                        <div class="center"><img src="{{session('uploaded_paths.path_3') ? asset('storage/' . session('uploaded_paths.path_3')) : ''}}" alt=""></div>
                </div>

                <div class="center">
                    <label>写真４</label>
                        <div class="center"><img src="{{session('uploaded_paths.path_4') ? asset('storage/' . session('uploaded_paths.path_4')) : ''}}" alt=""></div>
                </div>
            </div>

            <div class="form-item">
                <label>商品説明:</label>
                <div>{{$input['product_content']}}</div>
            </div>


            @if(session('previous_page')=='register')
                <input type="submit" class="ToList" value="登録完了">
            @elseif(session('previous_page')=='editer')
                <input type="submit" class="ToList" value="編集完了">
            @endif  
            
            <input type="submit" name="btn_back" class="btn_back" value="前に戻る">
            
        </form>
    </main>
</body>
</html>