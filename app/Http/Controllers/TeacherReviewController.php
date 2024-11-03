<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class TeacherReviewController extends Controller
{
    public function blocked(Review $review)
    {
        $review->update(['status' => 'blocked']);

        toast('Review has been blocked', 'success');

        return back();
    }

    public function getBlocked()
    {
        $courseIds = Auth::user()->accountable->courses->pluck('id');
        $reviews = Review::query()
            ->whereIn('course_id', $courseIds)
            ->where('status', 'blocked')
            ->with('student')
            ->get();

        return view('dashboard.pages.reviews.blocked', [
            'title' => 'Blocked Reviews',
            'reviews' => $reviews,
        ]);
    }

    public function unblock(Review $review)
    {
        $review->update(['status' => 'published']);

        toast('Review has been unblocked', 'success');

        return back();
    }
}
