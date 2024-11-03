<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::factory()->create([
            'name' => 'Admin',
        ]);
        Account::factory()->create([
            'accountable_id' => $admin->id,
            'accountable_type' => Admin::class,
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        $teacher = Teacher::factory()->create([
            'name' => 'Teacher',
        ]);
        Account::factory()->create([
            'accountable_id' => $teacher->id,
            'accountable_type' => Teacher::class,
            'email' => 'teacher@teacher.com',
            'password' => 'password',
        ]);

        $student = Student::factory()->create([
            'name' => 'Student',
        ]);
        Account::factory()->create([
            'accountable_id' => $student->id,
            'accountable_type' => Student::class,
            'email' => 'student@student.com',
            'password' => 'password',
        ]);
    }
}
