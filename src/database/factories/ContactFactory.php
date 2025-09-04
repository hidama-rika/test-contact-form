<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Contact::class;

    public function definition()
    {
        return [
            // ダミーの名前を生成
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            // ダミーの性別を生成
            'gender' => $this->faker->numberBetween(1, 3),
            // ダミーのメールアドレスを生成
            'email' => $this->faker->unique()->safeEmail(),
            // ダミーの電話番号を生成
            'tel' => $this->faker->phoneNumber(),
            // ダミーの住所を生成
            'address' => $this->faker->address(),
            // ダミーの建物名を生成（null許容）
            'building' => $this->faker->optional()->secondaryAddress(),
            // ダミーのお問い合わせ種類を生成
            'category_id' => $this->faker->numberBetween(1, 5), // カテゴリーIDは適宜調整してください
            // ダミーのお問い合わせ内容を生成
            'detail' => $this->faker->realText(100),
        ];
    }
}
