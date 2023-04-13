<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'    => 1,
            'scheme'     => $this->faker->word(),
            'domain'     => $this->faker->word(),
            'default'    => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
