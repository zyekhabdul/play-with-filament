<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fee_bills', function (Blueprint $table) {
            $table->id('fee_bill_id');

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('fee_package_id');

            $table->tinyInteger('month'); // 1 - 12
            $table->year('year');

            $table->unsignedBiginteger('total_amount');
            // $table->integer('paid_amount')->default(0);

            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])
                  ->default('unpaid');

            $table->timestamps();

            // Foreign keys
            $table->foreign('student_id')
                  ->references('student_id')
                  ->on('students')
                  ->cascadeOnDelete();

            $table->foreign('fee_package_id')
                  ->references('fee_package_id')
                  ->on('fee_packages');

            // Prevent duplicate monthly bills
            $table->unique(['student_id', 'month', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_bills');
    }
};
