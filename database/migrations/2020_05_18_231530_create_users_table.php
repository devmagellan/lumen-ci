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

            $table->string('first_name', 64);
            $table->string('middle_name', 64)->nullable();
            $table->string('last_name', 64);
            $table->string('gender', 16)->nullable();
            $table->date('birthdate')->nullable();

            $table->string('email', 64)->unique();
            $table->string('business_email', 64)->nullable()->unique();

            $table->string('phone', 16)->nullable();
            $table->string('mobile', 16)->nullable();
            $table->string('business_phone', 16)->nullable();
            $table->string('business_phone_extension', 16)->nullable();
            $table->string('business_mobile', 16)->nullable();
            $table->string('toll_free_business_number', 64)->nullable();

            $table->string('address', 16)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('state', 64)->nullable();
            $table->char('country', 2)->nullable();
            $table->string('zip_code', 16)->nullable();

            $table->string('password', 64);
            $table->string('secret_phrase', 255)->nullable();
            $table->string('fingerprint_code', 255)->nullable();
            $table->rememberToken();

            $table->enum('status', ['active', 'disabled'])->default('active');

            $table->timestamps();
            $table->softDeletes();
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
