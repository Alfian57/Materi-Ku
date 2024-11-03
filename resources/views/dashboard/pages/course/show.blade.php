@extends('dashboard.layouts.main')

@push('styles')
    <link rel="stylesheet" href="/assets/extensions/summernote/summernote-lite.css">
    <link rel="stylesheet" href="/assets/compiled/css/form-editor-summernote.css">
@endpush

@push('scripts')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/summernote/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['codeview']],
                ]
            });
        });
    </script>
@endpush

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>View Course</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $course->title) }}" readonly>
                    </div>

                    @if ($course->thumbnail)
                        <div class="form-group mt-3">
                            <label>Current Thumbnail</label>
                            <div>
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current Thumbnail"
                                    class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="course_category_id">Course Category</label>
                        <input type="text" class="form-control" id="course_category_id" name="course_category_id"
                            value="{{ $course->courseCategory->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="teacher_id">Teacher</label>
                        <input type="text" class="form-control" id="teacher_id" name="teacher_id"
                            value="{{ $course->teacher->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="10" readonly>{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $course->content) }}</textarea>
                        @error('content')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </form>

                <h4 class="mt-5">Reviews</h4>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Review</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->reviews as $item)
                            <tr>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->content }}</td>
                                <td>
                                    @if ($item->status === 'blocked')
                                        <form action="{{ route('dashboard.reviews.unblock', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('Are you sure want to unblock this review ?')"
                                                class="btn btn-sm btn-success">Unblock</button>
                                        </form>
                                    @else
                                        <form action="{{ route('dashboard.reviews.blocked', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('Are you sure want to block this review ?')"
                                                class="btn btn-sm btn-danger" @disabled($item->status === 'blocked')>Block</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
