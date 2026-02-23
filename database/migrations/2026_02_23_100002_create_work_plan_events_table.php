<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_plan_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_plan_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->date('date');
            $table->string('location')->nullable();
            $table->string('theme')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_plan_events');
    }
};
