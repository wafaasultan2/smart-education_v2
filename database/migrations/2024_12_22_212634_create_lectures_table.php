<?php

use App\Enums\Days;
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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id(); // العمود الأساسي ID
            $table->string('name'); // اسم المحاضرة
            $table->enum('time_lecture', ['EIGHT_TO_TEN', 'TEN_TO_TWELVE', 'TWELVE_TO_TWO', 'TWO_TO_FOUR']); // وقت المحاضرة
            $table->integer('group'); // المجموعة
            $table->enum('type', ['Practical', 'Theoretical']); // نوع المحاضرة (عملي/نظري)
            $table->enum('day', array_map(fn($case) => $case->value, Days::cases())); // أيام الأسبوع (بالاختصارات الإنجليزية)
            $table->foreignId('academic_year_id')->constrained('academic_years'); // السنة الأكاديمية
            $table->foreignId('course_id')->constrained('courses'); // الدورة
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null'); // المدرس
            $table->foreignId('classroom_id')->constrained('class_rooms'); // القاعة الدراسية
            $table->timestamps();
            $table->foreignId('term')->constrained('terms');
            $table->foreignId('year')->constrained('years');

            // إضافة الفهارس لتحسين الأداء
            $table->index('time_lecture', 'lecture_time_lecture_index'); // فهرس لوقت المحاضرة
            $table->index('group', 'lecture_group_index'); // فهرس للمجموعة
            $table->index('type', 'lecture_type_index'); // فهرس لنوع المحاضرة
            $table->index('day', 'lecture_day_index'); // فهرس ليوم المحاضرة
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
