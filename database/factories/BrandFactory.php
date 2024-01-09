<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    public function definition(): array
    {

        return [
            'slug' => $this->faker->slug(),
            'title' => $this->faker->title(),
            'thumbnail' => str_replace(public_path(), '' , $this->faker->file(
                base_path('tests/Fixtures/images/brands'),
                public_path('storage/images/brands')
            )),
            'on_home_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999)
        ];
    }
}
