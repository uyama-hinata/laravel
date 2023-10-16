<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
    <title>レビュー登録</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        @if(empty($review->id))
            <div class="header_main_msg">レビュー登録</div>
        @else
            <div class="header_main_msg">レビュー編集</div>
        @endif   
        
        
        <a href="{{route('adminReviewList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{ route('adminPostReview') }}" method="POST">
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
                    <label>商品</label>
                    <select class="form-select" name="product_id" id="product_id" >
                        <option value="" selected></option>
                        @foreach($products as $product)
                            @if(empty($review->id))
                                <option value="{{$product->id}}"@if(old('product_id') == $product->id)selected @endif>{{$product->name}}</option>
                            @else 
                                <option value="{{$product->id}}"@if(old('product_id', $review->product->id) == $product->id) selected @endif>{{$product->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>会員</label>
                    <select class="form-select" name="user_id" id="user_id" >
                        <option value="" selected></option>
                        @foreach($users as $user)
                            @if(empty($review->id))
                                <option value="{{$user->id}}"@if(old('user_id') == $user->id)selected @endif>{{$user->name_sei}}{{$user->name_mei}}</option>
                            @else 
                                <option value="{{$user->id}}"@if(old('user_id', $review->member_id) == $user->id) selected @endif>{{$user->name_sei}}{{$user->name_mei}}</option>
                            @endif
                        @endforeach
                    </select>
                </p>
            </div>

            <div class="form-item">
                <p>
                    ID
                    @if(empty($review->id))
                        登録後に自動採番
                    @else
                        {{$review->id}}
                        <input type="hidden" name="id" value="{{$review->id}}">
                    @endif
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>商品評価</label>
                    <select class="form-select" name="evaluation" id="evaluation" >
                        @if(empty($review->id))
                            <option value="" selected></option>
                            <option value="1" @if(old('evaluation') == 1)selected @endif>1</option>
                            <option value="2" @if(old('evaluation') == 2)selected @endif>2</option>
                            <option value="3" @if(old('evaluation') == 3)selected @endif>3</option>
                            <option value="4" @if(old('evaluation') == 4)selected @endif>4</option>
                            <option value="5" @if(old('evaluation') == 5)selected @endif>5</option>
                        @else 
                            <option value="" selected></option>
                            <option value="1" @if(old('evaluation') ? old('evaluation') == 1 :$review->evaluation == 1) selected @endif>1</option>
                            <option value="2" @if(old('evaluation') ? old('evaluation') == 2 :$review->evaluation == 2) selected @endif>2</option>
                            <option value="3" @if(old('evaluation') ? old('evaluation') == 3 :$review->evaluation == 3) selected @endif>3</option>
                            <option value="4" @if(old('evaluation') ? old('evaluation') == 4 :$review->evaluation == 4) selected @endif>4</option>
                            <option value="5" @if(old('evaluation') ? old('evaluation') == 5 :$review->evaluation == 5) selected @endif>5</option>
                        @endif
                    </select>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label for="comment">商品コメント</label>
                    <textarea name="comment" id="comment" cols="100%" rows="10" >@if(empty($review->id)){{old('comment')}}@else{{old('comment') ?? $review->comment}}@endif</textarea>
                </p>
            </div>
            
            <input type="submit" class="ToList" id="btn_next" value="確認画面へ"/>

        </form>
    </main>
</body>
</html>