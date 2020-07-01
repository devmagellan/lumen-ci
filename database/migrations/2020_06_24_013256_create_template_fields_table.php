<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTemplateFieldsTable.
 */
class CreateTemplateFieldsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('template_fields', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('template_id');
            $table->foreign('template_id')->references('id')->on('templates');
            $table->unsignedBigInteger('datatype_id');
            $table->integer('position');
            $table->string('group_name')->nullable();
            $table->enum('hide_mobile', ['Y', 'N'])->default('N');
            $table->enum('hide_tablet', ['Y', 'N'])->default('N');
            $table->enum('hide_desktop', ['Y', 'N'])->default('N');
            $table->enum('searchable', ['Y', 'N'])->default('Y');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('template_fields');
	}
}
