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
        if(!Schema::hasTable('documents')){
            Schema::create('documents', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('section_id');
                $table->string('name');
                $table->string('url')->nullable();
                $table->timestamps();

                $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
