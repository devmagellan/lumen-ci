<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('guard_name')->default('web');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('firm_id')->references('id')->on('firms');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
