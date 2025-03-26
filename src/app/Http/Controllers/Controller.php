<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;//
// ユーザーが投稿を削除して良いかなどの権限を確認する機能
use Illuminate\Foundation\Bus\DispatchesJobs;
//メールの送信や画像の処理をバックグラウンドで実行する機能
use Illuminate\Foundation\Validation\ValidatesRequests;
//バリデーション機能を使えるようにする
use Illuminate\Routing\Controller as BaseController;
//コントローラー機能を使えるようにする

class Controller extends BaseController//BaseController（基本的なコントローラー）を元にしてこのクラスが機能を継承している。
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //読み込んだ機能をこのControllerクラスで使えるようにする
}
