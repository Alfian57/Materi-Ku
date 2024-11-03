<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->numerify('##################'),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Teacher $teacher) {
            $teacher->account()->save(\App\Models\Account::factory()->make([
                'accountable_id' => $teacher->id,
                'accountable_type' => \App\Models\Teacher::class,
            ]));
        });
    }
}
