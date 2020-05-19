<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('key');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('extension');
            $table->string('mobile_number');
            $table->text('summary');

            $table->string('we_current_company');
            $table->string('we_job_title');
            $table->string('we_time_period');
            $table->text('we_description');

            $table->string('e_school');
            $table->string('e_dates_attended');
            $table->string('e_field_of_study');
            $table->string('e_grade');
            $table->string('e_activities_societies');
            $table->text('e_description');

            $table->enum('status', ['active', 'disabled']);
            $table->string('profile_image');
            $table->string('activation_code');
            $table->dateTime('activation_timestamp');
            $table->boolean('invited');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
