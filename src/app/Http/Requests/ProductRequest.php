<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;/**リクエストに対するデータバリデーションを簡単に構築する機能を使用する */

#ProductRequestクラス
class ProductRequest extends FormRequest/**FormRequestクラスを継承し、フォームデータのバリデーションルールを指定できるようにする */
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    //authorizeメソッドを公開(public)として定義し、リクエストを処理する前に実行され、リクエストが許可されるかどうか確認する
    {
        return true;//ユーザーがリクエストを常に許可されるように設定する
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    //フォームから送信されたデータを検証するためにバリデーションルールを定義する
    {
        return [
            'product_name' => 'required',
            //入力必須であることを指定しなければならない
            'product_price' => 'required|integer|between:0,10000',
            //整数で入力し、値が0から10000の範囲でなければならない。
            'product_image' => 'required|mimes:png,jpeg',
            //アップロードされているファイルの形式を.pngまたは.jpegでなければならない
            'product_season' => 'required',
            //入力必須でなければならない
            'product_description' => 'required|max:120'
            //商品の説明は必須で、最大120文字以内でなければならない

            //'required'=入力条件が揃わない場合エラーメッセージを出力する
        ];
    }

    public function messages()//バリデーションエラーに引っかかった際にエラーメッセージを表記する設定を行う。
    {
        return [
            'product_name.required' => '商品名を入力してください',
            //商品名がからの場合に「商品名を入力してください」と表示
            'product_price.required' => '値段を入力してください',
            //値段が入力されていない場合「値段を入力してください」と表示
            'product_price.integer' => '数値で入力してください',
            //価格が数値でない場合「数値で入力してください」と表示
            'product_price.between:0,10000' => '0~10000円以内で入力してください',
            //価格が0から10000の範囲外の場合に「０〜10000円以内で入力してください」と表示
            'product_image.required' => '商品画像を登録してください',
            //商品画像が選択されていない場合に「商品画像を登録してください」と表示
            'product_image.mimes:png,jpeg' => '「.png」または「.jpeg」形式でアップロードしてください',
            //画像ファイルが指定されていない形式でない場合に「.png」または「.jpeg」形式でアップロードしてください」と表示
            'product_season.required' => '季節を選択してください',
            //季節が選択され値ない場合に「季節を選択してください」と表示
            'product_description.required' => '商品説明を入力してください',
            //商品説明が空の場合に「商品説明を入力してください」と表示。
            'product_description.max:120' => '120文字以内で入力してください',
            //商品説明が120文字を超える場合に「120文字以内で入力してください」と表示。
        ];
    }
}


