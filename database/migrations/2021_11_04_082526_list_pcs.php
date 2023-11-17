<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListPcs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!(Schema::hasTable('list_pcs'))){
            Schema::create('list_pcs', function (Blueprint $table){
                $table->increments('id');
                $table->string('inv',100);
                $table->string('ser',100);
                $table->string('korp',100);
                $table->string('etaj',100);
                $table->string('pom',100);
                $table->string('kab',100);
                $table->string('pc',100);
                $table->string('ip',100);
                $table->string('mac',100);
                $table->string('os',100);
                $table->string('licos',100);
                $table->string('office',100);
                $table->string('licoffice',100);
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
        Schema::dropIfExists('list_pcs');
    }
}
