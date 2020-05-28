<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfessionalExperienceTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('users_professional_experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0)->unique();
            $table->string('current_company')->nullable();
            $table->string('job_title')->nullable();
            $table->string('time_period')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_professional_experience');
    }
}
