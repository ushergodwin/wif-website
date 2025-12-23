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
        Schema::create('partner_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('contact_person');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('partnership_interest');
            $table->enum('partnership_type', ['corporate', 'ngo', 'media', 'training', 'other'])->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'contacted', 'rejected'])->default('pending');
            $table->timestamps();
            
            // Indexes for filtering and searching
            $table->index('status');
            $table->index('partnership_type');
            $table->index('email');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_inquiries');
    }
};
