<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('labour_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('labour_bill_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->date('payment_date')->nullable();
            $table->string('payment_mode')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labour_payments');
    }
};
