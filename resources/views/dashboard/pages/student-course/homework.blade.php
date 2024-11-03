@extends('dashboard.layouts.main')

@push('styles')
    <style>
        .tile {
            position: relative;
            display: flex;
            align-items: flex-end;
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            padding: 20px;
            height: 250px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .tile:hover {
            transform: scale(1.05);
        }

        .tile-content {
            background: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 10px;
            width: 100%;
        }

        .tile-title {
            font-weight: bold;
        }

        .tile-text {
            font-size: 0.9rem;
        }

        .tile .btn-outline-light {
            transition: background-color 0.3s, color 0.3s;
        }

        .tile .btn-outline-light:hover {
            background-color: white;
            color: #007bff;
        }

        @media (max-width: 768px) {
            .tile {
                height: auto;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .tile-content {
                padding: 10px;
            }

            .tile-title {
                font-size: 1.2rem;
            }

            .tile-text {
                font-size: 0.8rem;
            }
        }
    </style>
@endpush


@section('content')
    <section class="section">
        <div class="container py-5">
            <h2 class="mb-3 text-primary text-center">Homeworks for {{ $course->title }}</h2>
            <p class="text-muted text-center"><strong>Category:</strong> {{ $course->courseCategory->name }}</p>

            <hr class="my-4">

            <div class="row justify-content-center gy-4">
                @foreach ($course->homeworks as $homework)
                    <div class="col-md-6 col-lg-4">
                        <div class="tile" style="background-image: url('{{ asset('storage/' . $course->thumbnail) }}')">
                            <div class="tile-content">
                                <h5 class="tile-title text-white">{{ $homework->title }}</h5>
                                <p class="tile-text text-light">{!! Str::limit($homework->content, 100) !!}</p>
                                <a href="{{ route('dashboard.student.course.form', [$course->slug, $homework->slug]) }}"
                                    class="btn btn-outline-light btn-sm mt-3">Do Homework</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
