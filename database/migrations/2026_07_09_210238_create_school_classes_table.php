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
    Schema::create('school_classes', function (Blueprint $table) {
        $table->id();

        $table->foreignId('academic_year_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('level');
        $table->string('major');
        $table->string('name');

        $table->unsignedInteger('capacity')->default(36);

        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->unique([
            'academic_year_id',
            'level',
            'major',
            'name',
        ]);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }
};
