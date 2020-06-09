<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id')->default(0);
            $table->string('address', 255);
            $table->string('fax', 16)->nullable();
            $table->string('phone', 16)->nullable();
            $table->string('postal_code', 16)->nullable();
            $table->string('alt_phone', 16)->nullable();
            $table->string('city', 64);
            $table->string('state', 64);
            $table->char('country', 2);
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
        Schema::dropIfExists('firm_addresses');
    }
}
