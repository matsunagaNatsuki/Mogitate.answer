<?php

namespace App\Models;

#必要な機能を取り入れる
use Illuminate\Database\Eloquent\Factories\HasFactory;
//テストデータを作成するための機能
use Illuminate\Database\Eloquent\Model;
//EloquentORMを使用するために必要な基本機能を読み込み、データベースのテーブルと対応するクラスを定義するための基盤を提供する。

#Productクラス
class Product extends Model//Model(データベースと連携している基本機能を引き継いでいる)
{
    use HasFactory;//テストデータを作成するための機能を引き継いでいる

    #seasonsメソッド
    public function seasons()
    {
        return $this->belongsToMany(Season::class,'product_season','product_id','season_id',);
        //「多対多」の関係を定義し、一つの商品が複数季節に関連助けられる。
    }

    //checkSeasonメソッド
    public function checkSeason($season,$product)
    //このメソッドは、特定の商品が指定された季節に関連づけられるかを確認する。
    {
        $season_id = $season->id;
        $product_id = $product->id;
        //渡されたseasonとproductからそれぞれのIDを取得

        $product_data = Product::find($product_id);
        //指定された商品をデータベースから取得する
        $productSeasons = $product_data->seasons;
        //その商品に関連づけられている季節を取得。

        foreach ($productSeasons as $productSeason)
        //商品に関連づけられた季節のリストでforeachループを使用してリスト内すべての季節を順番にチェックする。
        {
            if(($productSeason->id ?? null) == $season_id)
            //各季節（$productSeason)のIDが指定された季節のID（$season_id)と一致しているか確認している
            {
                $returnTxt ="yes";
                return $returnTxt;
                //IDが一致したらループを終了する。
            }
        }

        if(isset($productSeason) && $productSeason->id != $season_id)
        //季節IDが$season_idと違うか確認している。
        {
            $returnTxt ="no";
            return $returnTxt;
            //季節が一致しないと処理を終了させる。
        }
    }
}
