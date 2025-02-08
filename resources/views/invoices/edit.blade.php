@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Invoice</h2>

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Client Name:</label>
        <input type="text" name="client_name" value="{{ $invoice->client_name }}" class="form-control" required>

        <label>Invoice Number:</label>
        <input type="text" name="invoice_number" value="{{ $invoice->invoice_number }}" class="form-control" required>

        <label>Amount:</label>
        <input type="number" step="0.01" name="amount" value="{{ $invoice->amount }}" class="form-control" required>

        <label>Due Date:</label>
        <input type="date" name="due_date" value="{{ $invoice->due_date }}" class="form-control" required>

        <button type="submit" class="btn btn-success mt-3">Update Invoice</button>
    </form>
</div>
@endsection
