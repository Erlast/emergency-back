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
        if(!Schema::hasTable('workplaces')){
            Schema::create('workplaces', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ip_id');
                $table->unsignedBigInteger('department_id');
                $table->unsignedBigInteger('person_id')->nullable();
                $table->macAddress();
                $table->string('inventory_number');
                $table->string('serial_number');
                $table->integer('level');
                $table->string('room');
                $table->integer('office');
                $table->string('name');
                $table->unsignedBigInteger('operating_system_id');
                $table->string('os_serial_number')->nullable();
                $table->tinyInteger('programming_office');
                $table->string('po_serial_number');
                $table->timestamps();

                $table->foreign('ip_id')->references('id')->on('ips')->onDelete('cascade');
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
                $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workplaces');
    }
};
