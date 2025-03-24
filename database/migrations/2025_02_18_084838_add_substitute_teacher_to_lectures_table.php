<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('attendance_records', function (Blueprint $table) {
            $table->foreignId('substitute_teacher_id')->nullable()->constrained('teachers')->onDelete('set null'); // عمود البديل للمدرس
        });
    }

    public function down()
    {
        Schema::table('attendance_records', function (Blueprint $table) {
            $table->dropColumn('substitute_teacher_id');
        });
    }
};
