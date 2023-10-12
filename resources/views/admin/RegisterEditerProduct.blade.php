<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
    <title>商品登録</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        @if(empty($product->id))
            <div class="header_main_msg">商品登録</div>
        @else
            <div class="header_main_msg">商品編集</div>
        @endif   
        
        
        <a href="{{route('adminProductList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{ route('adminPostProduct') }}" method="POST">
            @csrf
            
            <div class="errors">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                @endif
            </div>
            
            <div class="form-item">
                <p>
                    ID
                    @if(empty($product->id))
                        登録後に自動採番
                    @else
                        {{$product->id}}
                        <input type="hidden" name="id" value="{{$product->id}}">
                    @endif
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>会員</label>
                    <select class="form-select" name="user_id" id="user_id" >
                        @if(empty($product->id))
                            <option value="" selected></option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}"@if(old('user_id') == $user->id)selected @endif>{{$user->name_sei}}{{$user->name_mei}}</option>
                            @endforeach
                        @else 
                            <option value="" selected></option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}"@if(old('user_id') ? old('user_id') == $user->id : $product->member_id == $user->id) selected @endif>{{$user->name_sei}}{{$user->name_mei}}</option>
                            @endforeach
                        @endif
                    </select>
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品名
                    <input type="text" name="product_name" value="@if(empty($product->id)){{old('product_name')}}@else{{old('product_name') ?? $product->name}}@endif"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>商品カテゴリ</label>
                    @if(empty($product->id))
                        <select class="form-select" name="product_category_id" id="product_category_id" >
                            <option value="" selected></option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(old('product_category_id')==$category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-select" name="product_subcategory_id" id="product_subcategory_id">
                            @if(!empty(old('product_subcategory_id')))
                            
                                @foreach($subcategories as $subcategory)
                                    @if($subcategory->product_category_id = old('product_category_id'))
                                        <option value="{{$subcategory->id}}"{{(old('product_subcategory_id') == $subcategory->id) ? "selected" : ""}}>{{ $subcategory->name }}</option>
                                    @endif
                                @endforeach
                                
                            @endif
                    @else
                        <select class="form-select" name="product_category_id" id="product_category_id" >
                            <option value="" selected></option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(old('product_category_id', $product->product_category_id) == $category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    
                        <select class="form-select" name="product_subcategory_id" id="product_subcategory_id">
                            @foreach($subcategories as $subcategory)
                                <option value="{{$subcategory->id}}" @if(old('product_subcategory_id', $product->product_subcategory_id) == $subcategory->id) selected @endif>{{$subcategory->name}}</option>
                            @endforeach
                        </select>
                    @endif
                    </select>
                </p>
            </div>

            <div class="form-item image">
                <label>商品写真</label>
                    
                <div class="center">
                    <label>写真１</label>
                    <div><img src="@if(empty($product->id)){{session('uploaded_paths.path_1') ? asset('storage/' . session('uploaded_paths.path_1')) : ''}}@else{{ asset('storage/' . $product->image_1) }}@endif" id="imageDisplay1" class="center"></div>
                    <div class="center"><input type="file" name="image_1" id ="image_1" ></div>
                    <div class="center"><button type="button" id="upload1">アップロード</button></div>
                </div>
                
                <div class="center">
                    <label>写真２</label>
                    <div><img src="@if(empty($product->id)){{session('uploaded_paths.path_2') ? asset('storage/' . session('uploaded_paths.path_2')) : ''}}}@else{{ asset('storage/' . $product->image_2) }}@endif" id="imageDisplay2" class="center"></div>
                    <div class="center"><input type="file" name="image_2" id ="image_2" ></div>
                    <div class="center"><button type="button" id="upload2">アップロード</button></div>
                </div>
            
                <div class="center">
                    <label>写真３</label>
                    <div><img src="@if(empty($product->id)){{session('uploaded_paths.path_3') ? asset('storage/' . session('uploaded_paths.path_3')) : ''}}@else{{ asset('storage/' . $product->image_3) }}@endif" id="imageDisplay3" class="center"></div>
                    <div class="center"><input type="file" name="image_3" id ="image_3" ></div>
                    <div class="center"><button type="button" id="upload3">アップロード</button></div>
                </div>
            
                <div class="center">
                    <label>写真４</label>
                    <div><img src="@if(empty($product->id)){{session('uploaded_paths.path_4') ? asset('storage/' . session('uploaded_paths.path_4')) : ''}}@else{{ asset('storage/' . $product->image_4) }}@endif" id="imageDisplay4" class="center"></div>
                    <div class="center"><input type="file" name="image_4" id ="image_4" ></div>
                    <div class="center"><button type="button" id="upload4">アップロード</button></div>
                </div>
            </div>

            <div class="form-item">
                <p>
                    <label for="product_content">商品説明</label>
                    <textarea name="product_content" id="product_content" cols="100%" rows="10" >@if(empty($product->id)){{old('product_content')}}@else{{old('product_content') ?? $product->product_content}}@endif</textarea>
                </p>
            </div>
            
            <input type="submit" class="ToList" id="btn_next" value="確認画面へ"/>

        </form>
    </main>

    <script>
        $(function(){
            // カテゴリを選択すると呼び出される関数
            $('#product_category_id').change(function(){
                var key=$('#product_category_id option:selected').val();
                console.log(key);

                // 選択されたカテゴリに基づいてサブを取得
                $.get(`/product-register/${key}`,function(data){
                    // サブカテゴリをクリア
                    var subcategorySelect=$('#product_subcategory_id');
                    subcategorySelect.empty();

                    // 新しいオプションを追加
                    data.forEach(function(subcategory){
                        subcategorySelect.append(`<option value="${subcategory.id}">${subcategory.name}</option>`);
                    });
                });
            });

            // 画像を保持
            document.getElementById("btn_next").onclick=function(){
                
                var image1Path="{{old('uploaded_paths.path_1')}}";
                if(image1Path){
                    document.getElementById('imageDisplay1').src='/storage/'+image1Path;
                }

                var image2Path="{{old('uploaded_paths.path_2')}}";
                if(image2Path){
                    document.getElementById('imageDisplay2').src='/storage/'+image2Path;
                }

                var image3Path="{{old('uploaded_paths.path_3')}}";
                if(image3Path){
                    document.getElementById('imageDisplay3').src='/storage/'+image3Path;
                }

                var image4Path="{{old('uploaded_paths.path_4')}}";
                if(image4Path){
                    document.getElementById('imageDisplay4').src='/storage/'+image4Path;
                }
            }

            
            function uploadImage(buttonID,imageID,inputName,hiddenInputID){
                // ボタン押下時の処理
                $(`#${buttonID}`).on('click',function(){

                    // FromDataオブジェクトを初期化
                    const formData=new FormData();
                    // 画像ファイルを追加
                    formData.append(inputName,$(`#${inputName}`)[0].files[0]);

                    $.ajax({
                        // アップロード先のエンドポイント
                        url:'/admin-upload',          
                        type:'POST',
                        // 送信するデータ
                        data:formData,
                        // 指定しない
                        contentType:false,
                        // クエリ文字に変換しない
                        processData: false,
                        // csrfトークンを追加
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                        // アップロード成功時
                        success:function(response){
                            // response.imageUrlにはサーバーから返された画像のURLが含まれている
                            // そのURLをimgタグのsrc属性にセット
                            if(response.path_1){$(`#${imageID}`).attr('src','/storage/'+ response.path_1);};
                            if(response.path_2){$(`#${imageID}`).attr('src','/storage/'+ response.path_2);};
                            if(response.path_3){$(`#${imageID}`).attr('src','/storage/'+ response.path_3);};
                            if(response.path_4){$(`#${imageID}`).attr('src','/storage/'+ response.path_4);};
                        },

                        // エラー時
                        error:function(){
                            alert('アップロードに失敗しました');
                        }
                    });
                });
            }
                
            // 定義したuploadImage関数を、各ボタンと関連するimgタグ、input要素に対して呼び出す
            uploadImage('upload1','imageDisplay1','image_1');
            uploadImage('upload2','imageDisplay2','image_2');
            uploadImage('upload3','imageDisplay3','image_3');
            uploadImage('upload4','imageDisplay4','image_4');
        });

        
    </script>

</body>
</html>