<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceAPIController extends Controller
{
    // Get all invoices
    public function index()
    {
        return response()->json(Invoice::all());
    }

    // Get a single invoice
    public function show($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }
        return response()->json($invoice);
    }

    // Create a new invoice
    public function store(Request $request)
    {
        $invoice = Invoice::create($request->all());
        return response()->json($invoice, 201);
    }

    // Update an existing invoice
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }
        $invoice->update($request->all());
        return response()->json($invoice);
    }

    // Delete an invoice
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }
        $invoice->delete();
        return response()->json(['message' => 'Invoice deleted successfully']);
    }
    public function debug()
{
    return response()->json(['message' => 'InvoiceAPIController is reachable']);
}
}
