<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.course-category.index', [
            'title' => 'Course Categories Management',
            'courseCategories' => CourseCategory::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('dashboard.pages.course-category.create', [
            'title' => 'Create Course Category',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        CourseCategory::create($validatedData);

        toast('Course category created successfully!', 'success');

        return redirect()->route('dashboard.course-categories.index');
    }

    public function edit(CourseCategory $courseCategory)
    {
        return view('dashboard.pages.course-category.edit', [
            'title' => 'Edit Course Category',
            'courseCategory' => $courseCategory,
        ]);
    }

    public function update(Request $request, CourseCategory $courseCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $courseCategory->update($validatedData);

        toast('Course category updated successfully!', 'success');

        return redirect()->route('dashboard.course-categories.index');
    }

    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->delete();

        toast('Course category deleted successfully!', 'success');

        return redirect()->route('dashboard.course-categories.index');
    }
}
