<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfanityIgnoresTable extends Migration
{
	public function up()
	{
		Schema::create('profanity_ignores', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('profanity_id');
            $table->foreign('profanity_id')->references('id')->on('profanities');
            $table->unsignedBigInteger('user_ignored_id')->nullable();
            $table->foreign('user_ignored_id')->references('id')->on('users');
            $table->unsignedBigInteger('firm_ignored_id')->nullable();
            $table->foreign('firm_ignored_id')->references('id')->on('firms');
            $table->enum('network_ignored_id', ['retailer', 'wholesaler', 'association', 'administration', 'customer', 'roughseller', 'miner', 'manufacturer', 'farm', 'laboratory', 'enhancer'])->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('profanity_ignores');
	}
}
