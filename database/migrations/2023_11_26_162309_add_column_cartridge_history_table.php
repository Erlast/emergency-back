<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCartridgeHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('cartridge_history','department_id')){
            Schema::table('cartridge_history', function (Blueprint $table) {
                $table->unsignedBigInteger('department_id')->nullable()->after('status_to');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('cartridge_history', ['department_id']);
    }
}
