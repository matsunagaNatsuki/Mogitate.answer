<?php

#Laravelが用意している便利ツールを使えるようにする。
use Illuminate\Database\Migrations\Migration;//データベースの構造の変更
use Illuminate\Database\Schema\Blueprint;//テーブルの設計図を作るためのツール
use Illuminate\Support\Facades\Schema;//データベースの操作を行う

class CreateProductsTable extends Migration//このファイルの全体の名前で設計図のようなもの
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//テーブルを作成したり新しい変更をデータベースに適用する。
    {
        Schema::create('products', function (Blueprint $table) { //データベースにproductsという新しいテーブルを作成しテーブルの中身を設計する
            $table->id();//商品の番号。
            $table->string('name');//商品名を保存
            $table->integer('price');//値段を保存。数字のみ入力可。
            $table->string('image')->nullable();//画像を保存。nullable=画像がない場合でもOK
            $table->text('description');//商品説明を保存。長い文章が入力できる
            $table->timestamp('create_at')->useCurrent()->nullable();
            $table->timestamp('update_at')->useCurrent()->nullable();
            /**データの作成と更新の時間を自動で保存する
                *useCurrent():=今の時刻を自動で設定する
                *nullable():=空でもOK**/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()//upメソッドで作成した変更を削除し元に戻す
    {
        Schema::dropIfExists('products');
        //productsテーブルがデータベースに存在している場合、productsテーブルを削除し、テーブルが存在しない場合は何もせずに終了する。これによってエラーを防ぐ。
    }
}
