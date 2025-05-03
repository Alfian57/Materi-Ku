<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Assignment;
use App\Models\Student;
use App\Models\Teacher;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $path = [
            storage_path('app/public/images/courses'),
            storage_path('app/public/images/profile-pic'),
            storage_path('app/public/assignments'),
        ];

        foreach ($path as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            chmod($dir, 0755);
        }

        foreach ($path as $dir) {
            if (File::exists($dir)) {
                foreach (File::files($dir) as $file) {
                    File::delete($file);
                }
            }
        }

        $this->call([
            AccountSeeder::class,
            CourseCategorySeeder::class,
        ]);

        Teacher::factory(25)->create();
        Student::factory(100)->create();
        Admin::factory(5)->create();

        $this->call([
            CourseSeeder::class,
            ReviewSeeder::class,
        ]);

        Assignment::factory(2500)->create();
    }
}
