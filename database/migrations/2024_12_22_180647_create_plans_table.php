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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('plan_uq');
            $table->text('description');
            $table->foreignId('department_id')->constrained()->onDelete('restrict');
            $table->timestamps();
            $table->index(['name'], 'plan_name_index');
            $table->fullText(['description'], 'plan_description_index');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
