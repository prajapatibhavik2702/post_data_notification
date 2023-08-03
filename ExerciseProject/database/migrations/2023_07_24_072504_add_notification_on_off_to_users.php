<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('notification_on_off')->default(true); // Default value is true (notification on)
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('notification_on_off');
    });
}
};
