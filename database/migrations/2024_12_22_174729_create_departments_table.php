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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique('dep_unique'); // اسم القسم
            $table->text('description')->nullable(); // وصف القسم
            $table->integer('PROFESSOR');
            $table->integer('ASSOCIATE_PROFESSOR');
            $table->integer('ASSISTANT_PROFESSOR');
            $table->integer('LECTURER');
            $table->integer('TEACHING_ASSISTANT');
            $table->timestamps();
            $table->index(['name', 'PROFESSOR', 'ASSOCIATE_PROFESSOR', 'ASSISTANT_PROFESSOR', 'LECTURER', 'TEACHING_ASSISTANT'], 'dept_salary_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
