@extends('dashboard.layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2>{{ $course->title }}</h2>
                <p><strong>Category:</strong> {{ $course->courseCategory->name }}</p>

                <hr>

                <!-- Menampilkan content HTML dari course -->
                <div class="course-content">
                    {!! $course->content !!}
                </div>

                <hr>

                <!-- Navigasi untuk Homework (jika ada) -->
                @if ($course->homeworks->count() > 0)
                    <div class="text-center mt-4">
                        <a href="{{ route('dashboard.student.course.homework', $course->slug) }}" class="btn btn-primary">
                            Check Homework
                        </a>
                    </div>
                @else
                    <div class="text-center mt-4">
                        <p>No homework available for this course.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
