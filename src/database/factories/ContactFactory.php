<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $fakerJa =
            \Faker\Factory::create('ja_JP');
        return [
            'category_id' =>
            Category::inRandomOrder()->value('id') ?? 1,
            'first_name' =>
            $fakerJa->firstName(),
            'last_name' =>
            $fakerJa->lastName(),
            'gender' =>
            $this->faker->randomElement([1, 2, 3]),
            'email' =>
            $this->faker->unique()->safeEmail(),
            'tel' => '0' .
                $this->faker->numerify('8#########'),
            'address' =>
            $fakerJa->address(),
            'building' =>
            $this->faker->optional()->secondaryAddress(),
            'detail' =>
            $this->faker->realText(80),

            'created_at' => now(),
            'updated_at' => now(),
            //
        ];
    }
}
