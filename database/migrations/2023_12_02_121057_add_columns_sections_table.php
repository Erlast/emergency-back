<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('sections', 'is_share')) {
            Schema::table('sections', function (Blueprint $table) {
                $table->smallInteger('is_share')->default(0)->after('name');
            });
        }

        if (!Schema::hasColumn('sections', 'order')) {
            Schema::table('sections', function (Blueprint $table) {
                $table->integer('order')->default(1)->after('is_share');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('sections', ['is_share', 'order']);
    }
};
