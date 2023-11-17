<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedCartridgeHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!(Schema::hasTable('cartridge_history'))) {
            Schema::create('cartridge_history', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cartridge_id');
                $table->string('status_from')->nullable();
                $table->string('status_to');
                $table->timestamps();
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
        Schema::dropIfExists('cartridge_history');
    }
}
