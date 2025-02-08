<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');  // Client Name
            $table->string('invoice_number')->unique(); // Unique Invoice Number
            $table->decimal('amount', 10, 2); // Invoice Amount
            $table->date('due_date'); // Payment Due Date
            $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid'); // Status
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
