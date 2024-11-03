@extends('dashboard.layouts.main')

@push('scripts')
    <script src="/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="/assets/static/js/pages/simple-datatables.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="/assets/extensions/simple-datatables/style.css">
@endpush

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $item)
                            <tr>
                                <td>{{ $item->course->title }}</td>
                                <td>{{ $item->content }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
