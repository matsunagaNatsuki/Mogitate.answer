<?php

/**このテーブルは中間テーブル（多対多の関係）を管理するためのテーブル。
 * 例：商品Id１の「商品」は季節Id３の「秋」の季節である*/




#laravelのフレームワークでデータベースを行う際に必要な機能やクラスを取り入れている
use Illuminate\Database\Migrations\Migration;
/**データベースにテーブルの列の追加や削除などを管理する
 * 例：upメソッドとdownメソッドを使ってテーブルの作成や削除を行う**/

use Illuminate\Database\Schema\Blueprint;
/**データベースのテーブル構造を設計するための便利なメソッドを提供する
 * 例：テーブルに「文字列型の列」や「ID」列を作成などを行う。*/

use Illuminate\Support\Facades\Schema;
/**データベースの構造を操作する機能
 * 例：データベースのテーブルの作成や変更、削除を行う*/

#Product_seasonテーブルを作成するための設計図
class CreateProductSeasonTable extends Migration
//Migrationクラスを継承し、テーブルの列の追加や削除などを管理する機能を使用する
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    #upメソッド
    public function up()//テーブルを作成するコードを記述する
    {
        Schema::create('product_season', function (Blueprint $table) {
            //product_seasonsという名前のテーブルを作成し、テーブルの項目を記述する
            $table->id();//データを区別するために自動でid番号を作成する
            $table->foreignId('product_id');
            /**productsのデータと関連つけるための外部キー
             * 例：この商品がどの季節に関連しているかを記録する**/

            $table->foreignId('season_id');
            /**seasonsテーブルと関連づける
             * 例：この季節がどの商品に関連しているかを記録する */
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            //自動で作成日時と更新日時を記録する
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    #downメソッド
    public function down()//upメソッドで作成したテーブルを削除する処理を行い、それを行うことでデータベースを元の状態に戻すことができる
    {
        Schema::dropIfExists('product_season');
        //product_seasonテーブルが存在していれば削除し、存在してなければそのまま終了する
    }
}



