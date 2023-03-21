<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;

//use Faker\Generator as Faker;


class CategoryFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {

        $name = $this->faker->realText(rand(40, 50));
        return [
            'name' => $name,
            'content' => $this->faker->realText(rand(150, 200)),
            'slug' => Str::slug($name),
        ];
    }

}
