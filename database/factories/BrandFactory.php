<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         $name = $this->faker->realText(rand(40, 50));
    return [
       'name' => $name,
        'content' =>  $this->faker->realText(rand(150, 200)),
        'slug' => Str::slug($name),
        
    ];

    }
}
