<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//データベースでダミーデータを作成する機能を取り入れる
use Illuminate\Database\Eloquent\Model;
//データベースのやり取りを行う機能を取り入れる

#seasonクラス
class Season extends Model
//Modelクラスを継承し、データベースのやり取りを行う機能を取り入れる。
{
    use HasFactory;//ダミーデータを作成する役割を行うHasFactory機能を使用する

//productsメソッド
    public function products()
    //季節が関連するための商品を取得するためのメソッド
    {
        return $this->belongsToMany(Product::class);
        //「多対多」の関係を定義し、Productモデルと関連している
    }
}
