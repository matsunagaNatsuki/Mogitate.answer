<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧ページ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
</head>
<body>
    <div class="all-contents">
        <form action="/products/update" method ="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="top-contents">
                <div class="left-content">
                    <p><span class="span-item">商品一覧></span>{{$product->name}}</p>
                    <img src="{{ asset($product->image) }}"  alt="店内画像" class="img-content"/>
                    @error('product_image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="right-content">
                    <label class="name-label">商品名</label>
                    <input type="text" placeholder="{{$product->name}}" name="product_name" class="text">
                    @error('product_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <label class="price-label">値段</label>
                    <input type="text" placeholder="{{$product->price}}" name="product_price" class="text">
                    @error('product_price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </span>
                    <label class="season-label">季節</label>
                    @foreach ($seasons as $season)
                        <input type="checkbox" id="season_{{ $season->id }}" name="product_season[]" value="{{ $season->id }}"
                        {{ in_array($season->id, old('product_season',$selectedSeasons ?? [])) ? 'checked' : ''}}>
                        <label for="season_{{ $season->id }}">{{ $season->name }}</label>
                    @endforeach
                    @error('product_season')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="under-content">
                <input type="file" id="product_image" class="image" name="product_image">
                <label class="description-label">商品説明</label>
                <textarea cols="30" rows="5"  placeholder="{{$product->description}}" name="product_description" class="product-description">{{$product->description}}</textarea>
                @error('product_description')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div class="button-content">
                    <a href="/products" class="back">戻る</a>
                    <button type="submit" class="button-change">変更を保存</button>
                    <div class="trash-can-content">
                        <a href="/products/{{$product->id}}/delete">
                            <img src="{{ asset('/images/trash-can.png') }}"  alt="ゴミ箱の画像" class="img-trash-can"/>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>