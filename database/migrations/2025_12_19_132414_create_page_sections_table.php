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
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page')->index(); // home, about, etc.
            $table->string('section_key')->index(); // unique identifier for the section
            $table->string('section_type')->default('text'); // text, image_text, list, values, objectives, etc.
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->longText('content')->nullable(); // Rich text content
            $table->string('image')->nullable();
            $table->json('items')->nullable(); // For lists, values, objectives, etc.
            $table->string('background_color')->nullable(); // light, primary, secondary, etc.
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->index(['page', 'section_key']);
            $table->index(['page', 'order']);
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
