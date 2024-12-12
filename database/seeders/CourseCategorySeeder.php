<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Programming',
            'Mathematics',
            'Science',
            'History',
            'Geography',
            'English',
            'Computer Science',
            'Physical Education',
            'Art',
            'Music',
            'Drama',
            'Dance',
            'Foreign Language',
            'Home Economics',
            'Woodwork',
            'Metalwork',
            'Agriculture',
            'Business Studies',
            'Economics',
            'Accounting',
            'Commerce',
            'Civic Education',
            'Government',
            'Social Studies',
            'Religious Studies',
            'Physical Science',
            'Biology',
            'Chemistry',
            'Physics',
            'Astronomy',
            'Geology',
        ];

        foreach ($categories as $category) {
            \App\Models\CourseCategory::create([
                'name' => $category,
            ]);
        }
    }
}
