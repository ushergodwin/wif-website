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
        Schema::table('projects', function (Blueprint $table) {
            $table->text('announcement_text')->nullable()->after('event_location');
            $table->string('announcement_link')->nullable()->after('announcement_text');
            $table->string('announcement_link_label')->nullable()->after('announcement_link');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['announcement_text', 'announcement_link', 'announcement_link_label']);
        });
    }
};
