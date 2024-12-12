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
        if (! File::exists(storage_path('/app/public/images/courses'))) {
            File::makeDirectory(storage_path('/app/public/images/courses'), 0755, true);
        }

        if (! File::exists(storage_path('/app/public/images/profile-pic'))) {
            File::makeDirectory(storage_path('/app/public/images/profile-pic'), 0755, true);
        }

        if (! File::exists(storage_path('/app/public/assignments'))) {
            File::makeDirectory(storage_path('/app/public/assignments'), 0755, true);
        }

        if (File::exists(storage_path('/app/public/images/courses'))) {
            $asset = storage_path('/app/public/images/courses');
            foreach (File::files($asset) as $file) {
                File::delete($file);
            }
        }

        if (File::exists(storage_path('/app/public/images/profile-pic'))) {
            $asset = storage_path('/app/public/images/profile-pic');
            foreach (File::files($asset) as $file) {
                File::delete($file);
            }
        }

        if (File::exists(storage_path('/app/public/assignments'))) {
            $asset = storage_path('/app/public/assignments');
            foreach (File::files($asset) as $file) {
                File::delete($file);
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
