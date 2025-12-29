<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');

            $table->unsignedBigInteger('fee_bill_id');
            $table->unsignedBigInteger('user_id');

            $table->date('payment_date');
            $table->unsignedBigInteger('amount_paid');
            $table->text('notes')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('fee_bill_id')
                  ->references('fee_bill_id')
                  ->on('fee_bills')
                  ->cascadeOnDelete();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
