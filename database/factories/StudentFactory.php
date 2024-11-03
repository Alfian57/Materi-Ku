<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
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
            'address' => $this->faker->address(),
            'level' => $this->faker->numberBetween(1, 3),
            'point' => $this->faker->numberBetween(0, 100),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Student $student) {
            $student->account()->save(\App\Models\Account::factory()->make([
                'accountable_id' => $student->id,
                'accountable_type' => \App\Models\Student::class,
            ]));
        });
    }
}
