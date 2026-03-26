<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition()
    {
        $categoryContents = [
            1 => [ // 商品のお届けについて
                '商品が届かないのですが、いつ頃発送されますか？',
                '配達日時の指定はできますか？',
            ],
            2 => [ // 商品の交換について
                '商品のサイズが合わなかったのですが、交換はできますか？',
                '返品したいのですが、手続き方法を教えてください。',
            ],
            3 => [ // 商品トラブル
                '注文した商品が破損して届いたのですが、交換してもらえますか？',
                '商品に不具合がありました。交換はできますか？',
            ],
            4 => [ // ショップへの問い合わせ
                'サービス内容について詳しくお聞きしたいです。',
                '取材の依頼をしたいのですが、どちらに連絡すればよいですか？',
            ],
            5 => [ // その他
                '支払い方法は何がありますか？',
                '領収書の発行をお願いしたいです。',
            ],
        ];

        $categoryId = $this->faker->randomElement(array_keys($categoryContents));

        $detail = $this->faker->randomElement($categoryContents[$categoryId]);

        return [
            'last_name'  => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'gender'     => $this->faker->numberBetween(1, 3),
            'email'      => $this->faker->safeEmail(),
            'tel'        => $this->faker->phoneNumber(),
            'address'    => $this->faker->prefecture() . $this->faker->city() . $this->faker->streetAddress(),
            'building'   => $this->faker->secondaryAddress(),
            'category_id' => $categoryId,
            'detail'      => $detail,
        ];
    }
}