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
            $table->unsignedInteger('firm_id');
            $table->unsignedInteger('user_id');
            $table->string('position', 128);
            $table->timestamps();
            $table->unique(['firm_id', 'user_id', 'position']);
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
