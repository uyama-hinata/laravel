<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
    <title>商品登録</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        
        <div class="form-title">
            商品登録
        </div>
        <form action="{{ route('postProduct') }}" method="POST">
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
                    <label >商品名</label>
                    <input type="text" name="name" value="{{old('name')}}" />
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>商品カテゴリ</label>
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
                        
                    </select>
                </p>
            </div>


            <div class="form-item image">
                <label>商品写真</label>
                    
                <div class="center">
                    <label>写真１</label>
                    <div><img src="{{session('uploaded_paths.path_1') ? asset('storage/' . session('uploaded_paths.path_1')) : ''}}" id="imageDisplay1" class="center"></div>
                    <div class="center"><input type="file" name="image_1" id ="image_1" ></div>
                    <div class="center"><button type="button" id="upload1">アップロード</button></div>
                </div>
                
                <div class="center">
                    <label>写真２</label>
                    <div><img src="{{session('uploaded_paths.path_2') ? asset('storage/' . session('uploaded_paths.path_2')) : ''}}" id="imageDisplay2" class="center"></div>
                    <div class="center"><input type="file" name="image_2" id ="image_2" ></div>
                    <div class="center"><button type="button" id="upload2">アップロード</button></div>
                </div>
            
                <div class="center">
                    <label>写真３</label>
                    <div><img src="{{session('uploaded_paths.path_3') ? asset('storage/' . session('uploaded_paths.path_3')) : ''}}" id="imageDisplay3" class="center"></div>
                    <div class="center"><input type="file" name="image_3" id ="image_3" ></div>
                    <div class="center"><button type="button" id="upload3">アップロード</button></div>
                </div>
            
                <div class="center">
                    <label>写真４</label>
                    <div><img src="{{session('uploaded_paths.path_4') ? asset('storage/' . session('uploaded_paths.path_4')) : ''}}" id="imageDisplay4" class="center"></div>
                    <div class="center"><input type="file" name="image_4" id ="image_4" ></div>
                    <div class="center"><button type="button" id="upload4">アップロード</button></div>
                </div>
            </div>

            <div class="form-item">
                <p>
                    <label for="product_content">商品説明</label>
                    <textarea name="product_content" id="product_content" cols="40" rows="10" >{{old('product_content')}}</textarea>
                </p>
            </div>

            <input  type="submit" class="btn_next" value="確認画面へ" id="btn_next">
            <a href="{{route('topLogin')}}" name="toLogin_btn" class="toTop">トップに戻る</a>
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

                    // // エラー時にサブカテゴリを保持
                    // if(oldSubcategory="{{old('product_subcategory_id')}}"){
                    //     subcategorySelect.val(oldSubcategory);
                    // }
                });
            });

            // 画像を保持
            document.getElementById("btn_next").onclick=function(){
                var image1Path="{{session('uploaded_paths.path_1')}}";
                if(image1Path){
                    document.getElementById('imageDisplay1').src='/storage/'+imagePath;
                }

                var image2Path="{{session('uploaded_paths.path_2')}}";
                if(image2Path){
                    document.getElementById('imageDisplay2').src='/storage/'+imagePath;
                }

                var image3Path="{{session('uploaded_paths.path_3')}}";
                if(image3Path){
                    document.getElementById('imageDisplay3').src='/storage/'+imagePath;
                }

                var image4Path="{{session('uploaded_paths.path_4')}}";
                if(image4Path){
                    document.getElementById('imageDisplay4').src='/storage/'+imagePath;
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
                        url:'/upload',          
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