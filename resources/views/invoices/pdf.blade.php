<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
        }
        .company-details {
            text-align: left;
            margin-bottom: 10px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .invoice-table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Invoices Report</h1>
        <p><strong>Date:</strong> {{ now()->format('F d, Y') }}</p>
    </div>

    <!-- Company Details -->
    <div class="company-details">
        <p><strong>Mosque Name:</strong> Jalalabad Prothom Masjid Ltd.</p>
        <p><strong>Address:</strong> Sylhet, Jalalabad, Bangladesh</p>
        <p><strong>Zip Code:</strong> 3100</p>
        <p><strong>Bkash Number:</strong> +880**********</p>
    </div>

    <!-- Billed To -->
    <div class="company-details">
        <p><strong>Billed To:</strong> Faiyaz Shahriar</p>
    </div>

    <!-- Invoice Table -->
    <table class="invoice-table">
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
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->client_name }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>${{ number_format($invoice->amount, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('F d, Y') }}</td>
                    <td>{{ $invoice->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Thank you for your donation!</p>
    </div>

</body>
</html>
