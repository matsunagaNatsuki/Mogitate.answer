<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;//ページネーション(複数ページにわたるデータ表示)の処理を簡単に行う
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function getProducts()
    //商品一覧を取得し、ページネーションを適用させてlist.blade.phpに渡す処理を行う
    {
        $products = Product::all();
        $perPage = 6;
        $page = Paginator::resolveCurrentPage('page');
        //現在のページ番号を取得
        $pageData = $products->slice(($page - 1) * $perPage, $perPage);
        //６件分ずつの商品データを抽出している
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        //現在のページのパスに基づいて正しいリンクを生成。例；?page=2
        ];

        $products = new LengthAwarePaginator($pageData, $products->count(), $perPage, $page, $options);
        //全体のデータを管理し、現在のページ番号やリンク生成などの機能(ページネーションオブジェクト)を提供します。

        return view('list', compact('products'));
        //商品データをlist.blade.phpに渡し、ページネーションリンクや商品リストを表示できるようにする
    }

    public function upload(ProductRequest $request)//フォームデータリクエストを受け取り処理するメソッド
    {
        $dir = 'images';//アップロードされた画像ファイルを保存するディレクトリを指定する

        $file_name = $request->file('product_image')->getClientOriginalName();
        //ユーザーのローカル環境で使用されたファイル名をそのまま取得する
        $request->file('product_image')->storeAs('public/' . $dir, $file_name);
        //指定したディレクトリにファイルを保存する

        $product_data = new Product();//新しい商品オブジェクトを作成
        $product_data->name= $_POST["product_name"];
        //フォームから送信された商品名の値を取得
        $product_data->price= $_POST["product_price"];
        //フォームから送信された値段の値を取得
        $product_data->image= 'storage/' . $dir . '/' . $file_name;
        //商品データの image プロパティに、画像ファイルの保存先パスを商品オブジェクトに設定する。
        $product_data->description= $_POST["product_description"];
        //フォームから送信された商品説明の値を取得
        $product_data->save();
        //商品オブジェクトが作成され、データベースの保存処理が実行される

        //商品オブジェクト＝商品に関するデータ（商品名、値段、画像、商品説明）をまとめた入れ物のようなものでデータベースのやり取りに使用される

        $products = Product::all();
        $perPage = 6;
        $page = Paginator::resolveCurrentPage('page');
        //現在表示中のページ番号を取得する
        //例：２ページ目にアクセスしている場合$page=2となる。
        $pageData = $products->slice(($page - 1) * $perPage, $perPage);
        //6件分ずつの商品データを抽出している
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        //現在のページのURLを取得し、「次のページ」や「前のページ」のリンクを生成する。URLのリンクが現在のページが２ページ目なら?page=2の形式のリンクが生成される。
        ];

        $products = new LengthAwarePaginator($pageData, $products->count(), $perPage, $page, $options);
        //ページネーション機能を提供するためのオブジェクト（現在のページに表示されるデータ、商品データの全件数、１ページあたりの表示件数、現在のページ番号、ページリンク生成に必要な設定）を作成している

        return redirect('/products');
        //ユーザーが商品を登録、変更をした後や、フォームを送信した後に自動で商品一覧ページに移動する
    }

    public function getSearch(Request $request)
    //ユーザーからのリクエストを受け取り、それに基づいて検索処理を行う
    {
        $query = Product::query();//商品データの検索クエリを準備する
        $sort = $request->input('sort');//ユーザーが選択した並び替え条件を取得する

        //並び替え条件を値段が高い順に変更
        if ($sort == "高い順に表示") {

            $sort = "high_price";

        }
        //並び替え条件を値段が低い順に変更
        elseif ($sort == "低い順に表示") {

            $sort = "low_price";

        }
        //ユーザーが並び替え条件を選択しなかった場合$sortを空の値に設定
        else{

            $sort = "";
        }


        if ($request->filled('keyword')) {
        //ユーザーが入力したキーワードを取得して$keywordを代入する

            $keyword = $request->input('keyword');
            //リクエストオブジェクトから特定の入力値（keyword)を取得する
            $query->where('name','like','%'.$keyword.'%');
            //部分検索を行う。大文字、小文字は区別しない

        }

        $query_products = $query->get();//データベースから検索結果を取得する

        if($sort == "high_price"){

            $products = $query_products->sortByDesc('price');
            $sort = "高い順に表示";

        }elseif($sort == "low_price"){

            $products = $query_products->sortBy('price');
            $sort = "低い順に表示";


        }else{

            $products = $query_products;
            $sort = "";

        }

        $perPage = 6;
        $page = Paginator::resolveCurrentPage('page');//ユーザーが２ページ目にアクセスしている場合は(page=2)
        $pageData = $products->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
            //ページネーションリンクを正しく生成する設定を行う
        ];

        $products = new LengthAwarePaginator($pageData, $products->count(), $perPage, $page, $options);
        //ページネーションオブジェクトを作成

        $seasons = Season::all();


        return view('list')->with(compact('sort','products','seasons'));
        //取得したデータをlistビューに渡す
    }

    public function postSearch(Request $request)
    //POSTリクエストを受け取って検索処理を開始する
    {
        $query = Product::query();//商品データに対して検索クエリを作成する
        $sort = $request->input('sort');//リクエストオブジェクトから並び替え条件を取得する

        if ($request->filled('keyword')) {

            $keyword = $request->input('keyword');
            $query->where('name','like','%'.$keyword.'%');
            //ユーザーがキーワードを入力した場合商品名を検索する

        }

        $query_products = $query->get();//$queryで作成した検索条件に基づいて、データベースから一致するレコードをすべて取得する

        if($sort == "high_price"){

            $products = $query_products->sortByDesc('price');
            $sort = "高い順に表示";

        }elseif($sort == "low_price"){

            $products = $query_products->sortBy('price');
            $sort = "低い順に表示";


        }else{

            $products = $query_products;
            $sort = "";

        }

        $perPage = 6;
        $page = Paginator::resolveCurrentPage('page');
        $pageData = $products->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ];

        $products = new LengthAwarePaginator($pageData, $products->count(), $perPage, $page, $options);

        $products->appends(['sort' => $sort]);

        $seasons = Season::all();

        return view('list')->with(compact('sort','products','seasons'));
    }

    public function postDelete($product_id)
    //商品を削除する処理を行うメソッド
    {
        $product = Product::find($product_id);
        //productsテーブルの中から渡された$product_idに一致する商品データを取得する
        $product->delete();//$productに格納された商品データをデータベースから削除する
        $message = "製品の削除が完了しました。";
        $products = Product::paginate(6);

        return redirect('/products')->with(compact('products','message'));
    }

    public function getDetail($product_id)
    //$product_idの詳細情報を取得し、detailに渡して表示するために使用される
    {
        $product = Product::find($product_id);
        //渡された$product_idに対応する商品データをデータベースから取得する
        $seasons = Season::all();

        return view('detail', compact('product','seasons'));
    }
}
