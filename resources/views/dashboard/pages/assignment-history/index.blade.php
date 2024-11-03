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
                            <th>Status</th>
                            <th>Points</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $item)
                            <tr>
                                <td>{{ $item->homework->course->title }}</td>
                                <td>
                                    @if ($item->status == 'submitted')
                                        <span class="badge bg-warning">Submitted</span>
                                    @elseif ($item->status == 'graded')
                                        <span class="badge bg-success">Graded</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 'submitted')
                                        <span class="badge bg-warning">Submitted</span>
                                    @elseif ($item->status == 'graded')
                                        {{ $item->point }}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->file)
                                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                            class="btn btn-sm btn-primary">View
                                            File</a>
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
