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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('start_date');
            $table->string('end_date');
            $table->timestamp('out_date')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('department_id')->constrained('departments')->onDelete('restrict');
            $table->foreignId('plan_id')->constrained('plans')->onDelete('restrict');
            $table->timestamps();

            $table->index('out_date', 'academic_year_out_date_index');
            $table->index('name', 'academic_year_name_index');
            $table->index('start_date', 'academic_year_start_date_index');
            $table->index('end_date', 'academic_year_end_date_index');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};
