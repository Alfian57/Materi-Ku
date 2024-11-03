<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Admin $admin) {
            $admin->account()->save(\App\Models\Account::factory()->make([
                'accountable_id' => $admin->id,
                'accountable_type' => \App\Models\Admin::class,
            ]));
        });
    }
}
