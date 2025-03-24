<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('attendance_records', function (Blueprint $table) {
            // إضافة العمود department_id
            $table->foreignId('department_id')
                ->constrained('departments') // يرتبط بجدول departments
                ->onDelete('cascade'); // إذا تم حذف القسم، يتم حذف سجلات الحضور المرتبطة به
        });
    }

    public function down()
    {
        Schema::table('attendance_records', function (Blueprint $table) {
            // حذف العلاقة أولاً
            $table->dropForeign(['department_id']);
            // ثم حذف العمود
            $table->dropColumn('department_id');
        });
    }
};
