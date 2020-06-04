<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->text('description')->nullable();
            $table->string('website', 255)->nullable();
            $table->decimal('discount', 9, 2)->nullable();
            $table->enum('type', ['retailer', 'wholesaler', 'association', 'administration', 'customer', 'roughseller', 'miner', 'manufacturer', 'farm', 'laboratory', 'enhancer'])->default('customer');
            $table->string('supplier', 256)->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active');
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
        Schema::dropIfExists('firms');
    }
}
