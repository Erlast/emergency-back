<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartridgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cartridges')) {
            Schema::create('cartridges', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('brand_id');
                $table->unsignedBigInteger('model_id');
                $table->string('sh_code')->unique();
                $table->tinyInteger('status');
                $table->unsignedBigInteger('department_id')->nullable();
                $table->tinyInteger('cin')->default(0);
                $table->timestamps();

                $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
                $table->foreign('model_id')->references('id')->on('printer_models')->onDelete('cascade');
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('cartridges');
    }
}
