<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['submitted', 'graded']);

        return [
            'status' => $status,
            'point' => $status === 'graded' ? $this->faker->numberBetween(0, 100) : null,
            'file' => 'assignments/' . $this->faker->file('storage/app/seeder/assignments', 'public/storage/assignments', false),
            'student_id' => \App\Models\Student::inRandomOrder()->first()->id,
            'homework_id' => \App\Models\Homework::inRandomOrder()->first()->id,
        ];
    }
}
