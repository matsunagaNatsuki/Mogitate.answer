<?php

use Illuminate\Support\Facades\Route;//ルーティングの設定を行うためのクラス
use App\Http\Controllers\ProductController;
//商品に関する処理を行うコントローラー
use App\Http\Controllers\SeasonController;
//季節に関する処理を行うコントローラー


#商品一覧ページ
Route::get('/products', [ProductController::class, 'getProducts']);
// /productsのURLがGETリクエストされた時、ProductControllerのgetProductsメソッドが実行される

#商品登録ページ
Route::get('/products/register', [SeasonController::class, 'getRegister']);
// /products/registerがGETリクエストされた時、SeasonControllerのgetRegisterメソッドが実行される

#商品データのアップロード
Route::post('/product/upload', [ProductController::class, 'upload']);
// /product/uploadにPOSTリクエストが送られてきた時、ProductControllerのuploadメソッド実行され、データや画像が送信されたときにアップロードする処理を行う

#商品詳細ページ
Route::get('/products/detail/{product_id}', [ProductController::class, 'getDetail']);
/**  /products/detail/{product_id}のURLがGETリクエストされたときProductControllerのgetDetailメソッドが実行される。
 * {product_id}は個別の製品IDを表す
*/

#商品検索フォーム
Route::get('/products/search', [ProductController::class, 'getSearch']);
// /products/searchがGETリクエストが送られたときProductControllerのgetSearchメソッドが実行され、商品を検索するためのフォームを表示する

#商品検索処理
Route::post('/products/search', [ProductController::class, 'postSearch']);
// /products/searchにPOSTリクエストが送られてきたときProductControllerのpostSearchメソッドが実行され、フォームで入力された検索条件を処理し、結果を表示する

#商品削除処理
Route::get('/products/{product_id}/delete', [ProductController::class, 'postDelete']);
// /products/{product/id}/deleteがGETリクエストされたときProductControllerのpostDeleteメソッドが実行され、IDがリクエストされた製品を削除する
