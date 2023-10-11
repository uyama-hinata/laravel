<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>カテゴリ登録</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        @if(empty($category->id))
            <div class="header_main_msg">カテゴリ登録</div>
        @else
            <div class="header_main_msg">カテゴリ編集</div>
        @endif   
        
        
        <a href="{{route('categoryList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{ route('adminPostCategory') }}" method="POST">
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
                    商品大カテゴリID
                    @if(empty($category->id))
                        登録後に自動採番
                    @else
                        {{$category->id}}
                        <input type="hidden" name="id" value="{{$category->id}}">
                    @endif
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品大カテゴリ
                    <input type="text" name="category" value="@if(empty($category->id)){{old('category')}}@else{{old('category') ?? $category->name}}@endif"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品小カテゴリ
                    <input type="hidden" name="subcategories" value="">

                    {{-- 編集画面 --}}
                    @if(!empty($category->id))
                        @foreach($subcategories as $index=>$subcategory)
                            <input type="text" name="subcategory{{$index +1}}" value="{{ old('subcategory'.($index +1), $subcategory->name)}}">
                        @endforeach
                        @for($i=count($subcategories);$i<10;$i++)
                            <input type="text" name="subcategory{{$i +1}}" value="{{ old('subcategory'.($i +1))}}">
                        @endfor

                    {{-- 登録画面 --}}
                    @else
                        @for($i=0;$i<10;$i++)
                        <input type="text" name="subcategory{{$i +1}}" value="{{ old('subcategory'.($i +1))}}">
                        @endfor
                    @endif
                </p>
            </div>
            
            <input type="submit" class="ToList" value="確認画面へ"/>

        </form>
    </main>
</body>
</html>