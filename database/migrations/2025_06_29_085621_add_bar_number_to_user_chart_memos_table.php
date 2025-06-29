<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_chart_memos', function (Blueprint $table) {
            $table->unsignedSmallInteger("bar_number")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_chart_memos', function (Blueprint $table) {
            $table->dropColumn("bar_number");
        });
    }
};
