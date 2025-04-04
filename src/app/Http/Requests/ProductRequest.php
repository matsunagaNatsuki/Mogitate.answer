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
            'product_price' => 'required|integer|between:0,10000',
            'product_image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'product_season' => 'required|array',
            'product_season.*' => 'integer',
            'product_description' => 'required|max:120'
        ];
    }

    public function messages()//バリデーションエラーに引っかかった際にエラーメッセージを表記する設定を行う。
    {
        return [
            'product_name.required' => '商品名を入力してください',
            'product_price.required' => '値段を入力してください',
            'product_price.integer' => '数値で入力してください',
            'product_price.between' => '0~10000円以内で入力してください',
            'product_image.required' => '商品画像を登録してください',
            'product_image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'product_season.required' => '季節を選択してください',
            'product_description.required' => '商品説明を入力してください',
            'product_description.max' => '120文字以内で入力してください',
        ];
    }
}


