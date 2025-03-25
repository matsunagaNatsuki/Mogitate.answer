<?php

namespace App\Models;

#必要な機能を読み込む
use Illuminate\Contracts\Auth\MustVerifyEmail;
//メール認証が必要な仕組みを取り入れる
use Illuminate\Database\Eloquent\Factories\HasFactory;
//データベースでテストデータを簡単に作る機能
use Illuminate\Foundation\Auth\User as Authenticatable;
//ユーザーのログイン認証を管理する基盤を取り入れる
use Illuminate\Notifications\Notifiable;
//メールなどの通知を送る仕組みを取り入れる
use Laravel\Sanctum\HasApiTokens;
//API(コンピュータやソフトウェア同士がやり取りをするためのルールや仕組みのこと)の機能を取り入れる。

#userクラス
class User extends Authenticatable
//Authenticatableの機能を引き継ぎ、Userというクラスを引き継ぐ
{
    use HasApiTokens, HasFactory, Notifiable;//この三つの機能を使用する

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        //データベースに保存や更新を行う際に変更を許可する情報を指定する。それがこの以下の３つに設定する。
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //データベースにデータを表示するときに隠したい情報を指定する
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //$castsを使用したことによってデータベースの列の値を指定した型（データタイプ）に変換する。
        'email_verified_at' => 'datetime',
        //'email_verified_at'はユーザーがメールアドレスを確認した日時が記録され、'datetime'の設定により時間差の計算や、フォーマット変更などの日時関連の操作が簡単にできる。
    ];
}
