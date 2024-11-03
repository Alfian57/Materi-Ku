<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.teacher.index', [
            'title' => 'Teacher Management',
            'teachers' => Teacher::with('account')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('dashboard.pages.teacher.create', [
            'title' => 'Create Teacher',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:accounts,email',
            'password' => 'required|min:8|confirmed',
            'nip' => 'required|string|size:18|unique:teachers,nip',
            'address' => 'required|string',
        ]);

        $teacher = Teacher::create($request->only('name', 'nip', 'address'));
        $teacher->account()->create($request->only('email', 'password'));

        toast('Teacher created successfully!', 'success');

        return redirect()->route('dashboard.teachers.index');
    }

    public function edit(Teacher $teacher)
    {
        return view('dashboard.pages.teacher.edit', [
            'title' => 'Edit Teacher',
            'teacher' => $teacher,
        ]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:accounts,email,'.$teacher->account->id,
            'password' => 'nullable|min:8|confirmed',
            'nip' => 'required|string|size:18|unique:teachers,nip,'.$teacher->id,
            'address' => 'required|string',
        ]);

        $teacher->update($request->only('name', 'nip', 'address'));
        $teacher->account()->update($request->only('email'));

        if ($request->filled('password')) {
            $teacher->account->update(['password' => $request->input('password')]);
        }

        toast('Teacher updated successfully!', 'success');

        return redirect()->route('dashboard.teachers.index');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->account->delete();
        $teacher->delete();

        toast('Teacher deleted successfully!', 'success');

        return redirect()->route('dashboard.teachers.index');
    }
}
