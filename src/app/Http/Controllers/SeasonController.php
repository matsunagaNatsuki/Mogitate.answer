<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class SeasonController extends Controller
{
    public function getRegister()//季節データを渡してビューに渡す
    {
        $seasons = Season::all();//seasonモデルを使用して、すべての季節データを取得している

        return view('register', compact('seasons'));
        //registerを返し、$seasons変数をビューに渡す
    }
}
