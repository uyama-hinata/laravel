<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <form action="{{route('exeProduct')}}" method="POST">
            @csrf
            <div class="form-title">商品登録確認画面</div>

            <div class="form-item">
                <label>商品名:</label>
                <div>{{$input['name']}}</div>
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


            <input type="submit" class="btn_next" value="商品を登録する">
            <input type="submit" name="btn_back" class="btn_back" value="前に戻る">
            
        </form>
    </main>
</body>
</html>