<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_extras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id')->default(0);
            $table->string('locale', 8)->default('en-US');
            $table->string('timezone', 64)->default('America/Los_Angeles');
            $table->char('currency', 3)->default('USD');
            $table->string('contact_name', 64)->nullable();
            $table->string('email', 255)->nullable();
            $table->integer('logo')->nullable();
            $table->integer('header_logo')->nullable();
            $table->integer('mobile_header_logo')->nullable();
            $table->string('headline', 256)->nullable();
            $table->decimal('discount_fee', 9, 2)->nullable();
            $table->decimal('as_discount_fee', 9, 2)->nullable();
            $table->integer('default_association')->nullable();
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
        Schema::dropIfExists('firm_extras');
    }
}
