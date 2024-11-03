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
                            <th>Name</th>
                            <th>Status</th>
                            <th>Point</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $item)
                            <tr>
                                <td>{{ $item->student->name }}</td>
                                <td>
                                    @if ($item->status == 'submitted')
                                        <span class="badge bg-warning">Submitted</span>
                                    @elseif($item->status == 'graded')
                                        <span class="badge bg-success">Graded</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($item->point))
                                        <span class="badge bg-warning">Not Graded</span>
                                    @else
                                        {{ $item->point }} Point
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.assignments.show', [$course->slug, $homework->slug, $item->id]) }}"
                                        class="btn btn-sm btn-primary {{ !is_null($item->point) ? 'disabled' : '' }}">Give
                                        Grade</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
