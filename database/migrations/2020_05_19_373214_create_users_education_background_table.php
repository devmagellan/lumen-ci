<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersEducationBackgroundTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('users_education_background', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0)->unique();
            $table->string('school')->nullable();
            $table->string('dates_attended')->nullable();
            $table->string('field_of_study')->nullable();
            $table->string('grade')->nullable();
            $table->string('activities_societies')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_education_background');
    }
}
