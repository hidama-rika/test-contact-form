<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lastname' => 'required',
            'firstname' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'tel' => 'required|numeric|digits_between:1,5',
            'address' => 'required',
            'category' => 'required',
            'detail' => 'required|max:120',

            // 結合された'tel'フィールドに対するバリデーション
            'tel' => 'required|numeric|digits_between:10,11',
        ];
    }

    /**
     * バリデーションのためにデータを準備します。
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // 3つの電話番号入力フィールドをハイフンなしで結合
        $tel = $this->tel_part1 . $this->tel_part2 . $this->tel_part3;

        // 結合した値を新しい'tel'フィールドとしてリクエストにマージ
        $this->merge([
            'tel' => $tel,
        ]);
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'lastname.required' => '姓を入力してください',
            'firstname.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel.required' => '電話番号を入力してください',
            'tel.numeric' => '電話番号は半角数字で入力してください',
            'tel.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
