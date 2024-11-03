<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherCourseController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.course.index', [
            'title' => 'Courses Management',
            'courses' => Course::query()
                ->with('courseCategory')
                ->where('teacher_id', Auth::user()->accountable->id)
                ->latest()
                ->get(),
        ]);
    }

    public function create()
    {
        return view('dashboard.pages.course.create', [
            'title' => 'Create Course',
            'courseCategories' => CourseCategory::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|image|max:2048',
            'content' => 'required',
            'course_category_id' => 'required|exists:course_categories,id',
        ]);

        $validatedData['teacher_id'] = Auth::user()->accountable->id;
        $validatedData['thumbnail'] = $request->file('thumbnail')->store('images/courses', [
            'disk' => 'public',
        ]);
        Course::create($validatedData);

        toast('Course created successfully!', 'success');

        return redirect()->route('dashboard.courses.index');
    }

    public function edit(Course $course)
    {
        return view('dashboard.pages.course.edit', [
            'title' => 'Edit Course',
            'courseCategories' => CourseCategory::latest()->get(),
            'teachers' => Teacher::latest()->get(),
            'course' => $course,
        ]);
    }

    public function show(Course $course)
    {
        return view('dashboard.pages.course.show', [
            'title' => 'Show Course',
            'course' => $course->load('reviews.student'),
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'content' => 'required|string|min:10',
            'course_category_id' => 'required|exists:course_categories,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($course->thumbnail);
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('images/courses', [
                'disk' => 'public',
            ]);
        } else {
            unset($validatedData['thumbnail']);
        }

        $course->update($validatedData);

        toast('Course updated successfully!', 'success');

        return redirect()->route('dashboard.courses.index');
    }

    public function destroy(Course $course)
    {
        Storage::disk('public')->delete($course->thumbnail);
        $course->delete();

        toast('Course deleted successfully!', 'success');

        return redirect()->route('dashboard.courses.index');
    }
}
