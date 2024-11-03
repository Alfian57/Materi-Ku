@extends('dashboard.layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($courses as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top" alt="Thumbnail"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text"><strong>Category:</strong> {{ $item->courseCategory->name }}</p>
                                    <p class="card-text">{{ Str::limit($item->description, 100) }}</p>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('dashboard.student.course.learn', $item->slug) }}"
                                        class="btn btn-sm btn-primary">
                                        Learn Course
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
