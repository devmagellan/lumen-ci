<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id')->default(0);
            $table->string('email', 64)->default('')->unique();
            $table->string('password', 64)->default('');
            $table->string('key', 32)->default('');
            $table->string('first_name', 64)->default('');
            $table->string('last_name', 64)->default('');
            $table->string('phone_number', 16)->nullable();
            $table->string('extension', 16)->nullable();
            $table->string('mobile_number', 16)->nullable();
            $table->text('summary')->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->integer('profile_image')->nullable();
            $table->string('activation_code', 64)->nullable();
            $table->dateTime('activation_timestamp')->nullable();
            $table->boolean('invited')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
