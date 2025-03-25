<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//データベースのダミーデータを簡単に作成する機能を取り入れる。
use Illuminate\Database\Eloquent\Model;
//データベースのテーブルと対応する基本機能を取り入れる

#productSeasonクラス
class productSeason extends Model
//Modelを継承し,検索、保存、更新、削除の機能を行なっている
{
    use HasFactory;//ダミーデータを自動生成できる機能を有効にする。
}
