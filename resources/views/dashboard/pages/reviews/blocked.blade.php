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
                            <th>Review</th>
                            <th class="w-25">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $item)
                            <tr>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->content }}</td>
                                <td>
                                    <form action="{{ route('dashboard.reviews.unblock', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Are you sure want to unblock the review ?')"
                                            class="btn btn-sm btn-danger">Unblock</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
