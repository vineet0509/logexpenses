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
        Schema::create('labour_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('labour_contractor_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->text('work_description')->nullable();
            $table->date('bill_date')->nullable();
            $table->enum('status', ['Pending', 'Partially Paid', 'Paid'])->default('Pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labour_bills');
    }
};
