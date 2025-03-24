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
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // العمود الأساسي ID
            $table->string('name'); // اسم الدورة
            $table->enum('level', ['First', 'Second', 'Third', 'Fourth']); // مستوى الدورة
            $table->enum('term', ['First', 'Second']); // الفصل الدراسي
            $table->enum('type', ['Mandatory', 'Specialized']); // نوع الدورة (متطلبة/تخصصية)
            $table->timestamps(); // تاريخ الإنشاء والتحديث

            // إضافة الفهارس لتحسين الأداء
            $table->index('name', 'course_name_index'); // فهرس لاسم الدورة
            $table->index(['level', 'term','type'], 'course_level_term_type_index'); // فهرس لمستوى الدورة والفصل الدراسي
        });


        Schema::create('plans_courses', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('plan_id');
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('plans_courses');
    }
};
