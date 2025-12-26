<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');

            $table->string('nis')->unique();
            $table->string('name');
            $table->enum('class', [
            'X PPLG', 'XI PPLG', 'X TKP',
            'XI TKP', 'X UPT', 'XI UPT'
            ]);
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();

            $table->boolean('is_active')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};