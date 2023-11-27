<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRefreshTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_refresh_tokens')) {
            Schema::create('user_refresh_tokens', function (Blueprint $table) {
                $table->id();
                $table->string('token')->unique();
                $table->dateTime('expires_at');
                $table->unsignedBigInteger('user_id');

                $table->timestamps();

                $table->index('user_id');

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_refresh_tokens');
    }
}
