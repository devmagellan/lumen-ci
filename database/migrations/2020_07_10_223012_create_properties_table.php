<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function(Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->enum('datatype', ['text', 'number', 'date', 'single_select', 'multi_select'])->default('text');
            $table->string('display_name') ;
            $table->string('header_name');
             $table->string('region');
             $table->string('description');
             $table->boolean('required');
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
        Schema::drop('properties');
    }
}
