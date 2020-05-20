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
            $table->string('email')->unique()->default('');
            $table->string('password')->default('');
            $table->string('key')->default('');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('phone_number')->nullable();
            $table->string('extension')->nullable();
            $table->string('mobile_number')->nullable();
            $table->text('summary')->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->string('profile_image')->nullable();
            $table->string('activation_code')->nullable();
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
