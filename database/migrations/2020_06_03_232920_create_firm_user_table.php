<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmUserTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('firm_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('firm_id')->references('id')->on('firms');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->unique(['firm_id', 'user_id']);
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firm_user');
    }
}
