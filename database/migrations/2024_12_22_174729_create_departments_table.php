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
        // إنشاء جدول الأقسام
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

        // تعديل جدول المعلمين لإضافة حقل department_id وربطه مع جدول الأقسام
        Schema::table('teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null'); // ربط مع جدول الأقسام
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // حذف القيد الأجنبي وحقل department_id من جدول المعلمين
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });

        // حذف جدول الأقسام
        Schema::dropIfExists('departments');
    }
};
