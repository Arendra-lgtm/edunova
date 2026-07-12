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
    Schema::create('students', function (Blueprint $table) {
        $table->id();

        $table->foreignId('academic_year_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('school_class_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('nis')->unique();
        $table->string('nisn')->unique();

        $table->string('name');

        $table->enum('gender', [
            'Laki-laki',
            'Perempuan',
        ]);

        $table->date('birth_date')->nullable();

        $table->text('address')->nullable();

        $table->boolean('is_active')
            ->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
