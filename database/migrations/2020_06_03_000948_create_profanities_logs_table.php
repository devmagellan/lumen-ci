<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfanitiesLogsTable extends Migration
{
    public function up()
    {
        Schema::create('profanity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('firm_id')->nullable();
            $table->foreign('firm_id')->references('id')->on('firms');
            $table->longText('original_content');
            $table->longText('updated_content');
            $table->mediumText('replaced_words');
            $table->string('class_name');
            $table->string('method');
            $table->string('table_name');
            $table->string('table_field');
            $table->string('table_id');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profanity_logs');
    }
}
