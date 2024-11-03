<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.pages.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard.index'));
        }

        toast('Invalid credentials!', 'error');

        return back();
    }

    public function register()
    {
        return view('auth.pages.register', [
            'title' => 'Register',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|email|unique:accounts,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = Student::create($request->only('name', 'address'));
        $student->account()->create($request->only('email', 'password'));

        toast('Account created successfully!', 'success');

        return redirect()->route('dashboard.login.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('dashboard.login.index');
    }
}
