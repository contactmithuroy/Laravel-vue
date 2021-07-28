<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {  
        $title = $this->faker->sentence(1);
        $slug = Str::slug($title,'-');
        $img = rand(100,500);
        return [
            'title'=>$title,
            'slug'=>$slug,
            'user'=>1,
            'category_id'=>1,
            'price'=> rand(100,500),
            'image'=>"https://placekitten.com/640/$img",
            'description'=>$this->faker->paragraph(5),
        ];
    }
}
