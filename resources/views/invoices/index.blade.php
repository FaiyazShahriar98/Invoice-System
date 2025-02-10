@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoices</h2>
    <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create Invoice</a>
    <a href="{{ route('invoices.export') }}" class="btn btn-success mb-3">
    <i class="fas fa-file-pdf"></i> Export PDF
</a>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Form -->
    <form method="GET" action="{{ route('invoices.index') }}" class="d-flex gap-2">
    <!-- Status Filter -->
    <select name="status" class="form-control">
        <option value="">All Status</option>
        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
    </select>

    <!-- Start Date Filter -->
    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">

    <!-- End Date Filter -->
    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">

    <!-- Filter Button -->
    <button type="submit" class="btn btn-dark">Filter</button>

    <!-- Clear Filter Button -->
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Clear Filter</a>
</form>

<div class="d-flex justify-content-center">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div>

    <table class="table">
    <thead>
    <tr>
        <th>
            <a href="{{ route('invoices.index', ['sort' => 'client_name', 'direction' => request()->query('sort') == 'client_name' && request()->query('direction') == 'asc' ? 'desc' : 'asc']) }}">
                Client Name {!! request()->query('sort') == 'client_name' ? (request()->query('direction') == 'asc' ? '▲' : '▼') : '' !!}
            </a>
        </th>
        <th>
            <a href="{{ route('invoices.index', ['sort' => 'invoice_number', 'direction' => request()->query('sort') == 'invoice_number' && request()->query('direction') == 'asc' ? 'desc' : 'asc']) }}">
                Invoice Number {!! request()->query('sort') == 'invoice_number' ? (request()->query('direction') == 'asc' ? '▲' : '▼') : '' !!}
            </a>
        </th>
        <th>
            <a href="{{ route('invoices.index', ['sort' => 'amount', 'direction' => request()->query('sort') == 'amount' && request()->query('direction') == 'asc' ? 'desc' : 'asc']) }}">
                Amount {!! request()->query('sort') == 'amount' ? (request()->query('direction') == 'asc' ? '▲' : '▼') : '' !!}
            </a>
        </th>
        <th>
            <a href="{{ route('invoices.index', ['sort' => 'due_date', 'direction' => request()->query('sort') == 'due_date' && request()->query('direction') == 'asc' ? 'desc' : 'asc']) }}">
                Due Date {!! request()->query('sort') == 'due_date' ? (request()->query('direction') == 'asc' ? '▲' : '▼') : '' !!}
            </a>
        </th>
        <th>
            <a href="{{ route('invoices.index', ['sort' => 'status', 'direction' => request()->query('sort') == 'status' && request()->query('direction') == 'asc' ? 'desc' : 'asc']) }}">
                Status {!! request()->query('sort') == 'status' ? (request()->query('direction') == 'asc' ? '▲' : '▼') : '' !!}
            </a>
        </th>
        <th>Actions</th>
    </tr>
</thead>

        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->client_name }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>${{ number_format($invoice->amount, 2) }}</td>
                    <td>{{ $invoice->due_date }}</td>
                    <td>
                        @if($invoice->status === 'Unpaid')
                            <span class="badge bg-danger">Unpaid</span>
                        @else
                            <span class="badge bg-success">Paid</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>

                        @if($invoice->status === 'Unpaid')
                            <form action="{{ route('invoices.toggleStatus', $invoice->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Mark as Paid</button>
                            </form>
                        @else
                            <form action="{{ route('invoices.toggleStatus', $invoice->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-secondary btn-sm">Mark as Unpaid</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div>

</div>
@endsection
