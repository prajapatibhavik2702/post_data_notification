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
        Schema::table('user_notification_post', function (Blueprint $table) {
            // Add the 'read' column
            $table->boolean('read')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_notification_post', function (Blueprint $table) {
            // If you want to rollback, remove the 'read' column
            $table->dropColumn('read');
        });
    }
};
