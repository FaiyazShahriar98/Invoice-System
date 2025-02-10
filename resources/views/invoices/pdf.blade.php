<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Invoices Report</h2>
    <table>
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->client_name }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>${{ number_format($invoice->amount, 2) }}</td>
                    <td>{{ $invoice->due_date }}</td>
                    <td>{{ ucfirst($invoice->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
