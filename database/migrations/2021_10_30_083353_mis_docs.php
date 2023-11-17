<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MisDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!(Schema::hasTable('mis_docs'))) {
            Schema::create('mis_docs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 200);
                $table->string('doc', 200);
                $table->string('razdel', 10);
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
        Schema::dropIfExists('mis_docs');
    }
}
