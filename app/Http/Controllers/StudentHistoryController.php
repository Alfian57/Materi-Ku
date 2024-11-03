<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StudentHistoryController extends Controller
{
    public function getReviewHistories()
    {
        return view('dashboard.pages.review-history.index', [
            'title' => 'Review Histories',
            'reviews' => Auth::user()->accountable->reviews->load('course'),
        ]);
    }

    public function getAssignmentHistories()
    {
        return view('dashboard.pages.assignment-history.index', [
            'title' => 'Assignment Histories',
            'assignments' => Auth::user()->accountable->assignments->load('homework', 'homework.course'),
        ]);
    }
}
