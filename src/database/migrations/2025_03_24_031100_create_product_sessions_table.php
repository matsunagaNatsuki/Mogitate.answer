<?php

/**sessionsテーブルをデータベースに作成し、ユーザーのセッション情報を管理するためのテーブル。
 * セッション情報とはユーザーがどのような活動をしているかを追跡し記録を行うデータ。
 * これを行うことで、ユーザー体験を向上させたり、安全な接続の維持ができる
 */


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            //sessionsというテーブルを作成し、テーブルに必要な列（カラム）を定義する
            $table->string('id')->primary();
            //セッションを区別する番号や文字列が保存される

            $table->foreignId('user_id')->nullable()->index();
            //インデックスを作成して、user_idを検索する速度を早くし、このユーザーがどのセッションを利用しているかを保存する。

            $table->string('ip_address', 45)->nullable();
            /**IPアドレスのデータ型を文字列として定義し、保存します。
             * IPv4（最大15文字）とIPv6（最大45文字）に対応できます。
             * IPアドレスは、どこから接続しているかを示す情報です。*/

            $table->text('useragent')->nullable();
            //ユーザーが使用しているブラウザやデバイスの情報を保存する。
            $table->text('payload');
            //カート内の商品情報などセッションごとに保持したい情報が格納される。

            $table->integer('last_activity')->index();
            //検索速度を向上させるためにインデックスコードを追加し、ユーザーが最後に何か操作を行なった日時を保存する
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
