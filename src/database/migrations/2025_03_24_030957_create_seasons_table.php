<?php

#laravelの用意している便利なツールを使えるようにしている
use Illuminate\Database\Migrations\Migration;//データベースを変更するための機能
use Illuminate\Database\Schema\Blueprint;//テーブルの設計を簡単に記述するための仕組み。
use Illuminate\Support\Facades\Schema;//データベース構造を直接操作するためのツール

#CreateSeasonsTableという名前の設計図
class CreateSeasonsTable extends Migration //このクラスにテーブル作成や削除を行えるようにする
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    #upメソッド
    public function up() //seasonsテーブルにに新しくデータの変更を行えるようにする
    {
        Schema::create('seasons', function (Blueprint $table) {
            //テーブルの中身を設計し、データベースに「seasons」という名前のテーブルを作成する
            $table->id();//データを区別するために「id」という列を作り、自動で番号が振られる
            $table->string('name');//季節の名前を保存する列
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            //作成日時と更新日時を自動で保存する
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    #downメソッド
    public function down()//upメソッドで作成した変更を削除し元に戻す
    {
        Schema::dropIfExists('seasons');
        //seasonsテーブルがデータベースに存在している場合、seasonsテーブルを削除し、テーブルが存在しない場合は何もせずに終了する。これによってエラーを防ぐ。
    }
}
