<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::query();
        
        // Apply Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply Date Range Filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('due_date', [$request->start_date, $request->end_date]);
        }

        // Sorting
        $sortColumn = $request->get('sort', 'due_date'); 
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortColumn, $sortDirection);

        // Pagination
        $invoices = $query->paginate(10); // Show 10 per page

        return view('invoices.index', compact('invoices', 'sortColumn', 'sortDirection'));
    }

    // ✅ Fixed Export Function
    public function export()
    {
        $invoices = Invoice::all(); // Fetch all invoices
    
        $pdf = Pdf::loadView('invoices.pdf', compact('invoices'));
    
        return $pdf->download('invoices.pdf'); // Return the PDF as a downloadable file
    }
    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'invoice_number' => 'required|unique:invoices',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        Invoice::create($request->all());

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'client_name' => 'required',
            'invoice_number' => 'required|unique:invoices,invoice_number,'.$invoice->id,
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        $invoice->update($request->all());

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $invoice = Invoice::findOrFail($id);

        // Toggle between 'Paid' and 'Unpaid'
        $invoice->status = ($invoice->status === 'Paid') ? 'Unpaid' : 'Paid';
        $invoice->save();

        return redirect()->back()->with('success', "Invoice status updated to {$invoice->status}.");
    }
}
