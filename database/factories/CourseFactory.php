<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'content' => $this->faker->paragraphs(3, true),
            'thumbnail' => 'images/courses/' . $this->faker->file('storage/app/seeder/courses', 'public/storage/images/courses', false),
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()->id,
            'course_category_id' => \App\Models\CourseCategory::inRandomOrder()->first()->id,
        ];
    }
}
