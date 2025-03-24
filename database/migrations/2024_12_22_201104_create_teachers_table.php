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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('num_job');
            $table->string('name');
            $table->enum('academic_degree', ['PROFESSOR', 'ASSOCIATE_PROFESSOR', 'ASSISTANT_PROFESSOR', 'LECTURER', 'TEACHING_ASSISTANT']);
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->text('image')->nullable();
            $table->timestamps();
            $table->index('num_job', 'teacher_num_job_index');
            $table->index('name', 'teacher_name_index');
            $table->index('email', 'teacher_email_index');
            $table->index('academic_degree', 'teacher_academic_degree_index');
        });

        Schema::create('courses_teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('courses_teachers');
    }
};
