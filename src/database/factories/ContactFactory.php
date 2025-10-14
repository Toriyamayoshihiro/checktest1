<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $this->faker = \Faker\Factory::create('ja_JP');
        $customSentences=[
           '届いた商品が注文した商品ではありませんでした。商品の交換をお願いします。',
           '商品が壊れていました。',
           '返品したいです。',
           '商品が届きません。',
           '商品の部品が足りません。' 
        ];
        return [
        'category_id'=> $this->faker->numberBetween(1,5),
        'first_name'=>$this->faker->firstName,
        'last_name'=>$this->faker->lastName,
        'gender'=>$this->faker->numberBetween(1,3),
        'email'=> $this->faker->unique()->safeEmail,
        'tel'=> $this->faker->numerify('090########'),
        'address'=>$this->faker->address,
        'building'=>$this->faker->secondaryAddress,
        'detail'=>$this->faker->randomElement($customSentences),
        ];
    }
}
