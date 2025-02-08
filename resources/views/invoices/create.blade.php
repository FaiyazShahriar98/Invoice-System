@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Invoice</h2>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <label>Client Name:</label>
        <input type="text" name="client_name" class="form-control" required>

        <label>Invoice Number:</label>
        <input type="text" name="invoice_number" class="form-control" required>

        <label>Amount:</label>
        <input type="number" step="0.01" name="amount" class="form-control" required>

        <label>Due Date:</label>
        <input type="date" name="due_date" class="form-control" required>

        <button type="submit" class="btn btn-success mt-3">Save Invoice</button>
    </form>
</div>
@endsection
