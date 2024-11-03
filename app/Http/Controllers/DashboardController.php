<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Homework;
use App\Models\Review;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->accountable_type === 'App\Models\Student') {
            return view('dashboard.pages.dashboard.student', [
                'title' => 'Dashboard',
                'courses' => Course::with('courseCategory')->latest()->paginate(9),
            ]);
        }

        $data = [
            'title' => 'Dashboard',
            'teacherCount' => Teacher::count(),
            'studentCount' => Student::count(),
            'courseCount' => Course::count(),
            'homeworkCount' => Homework::count(),
            'latestReviews' => Review::with('student')->latest()->limit(5)->get(),
        ];

        return view('dashboard.pages.dashboard.admin-teacher', $data);
    }
}
