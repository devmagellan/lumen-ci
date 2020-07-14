<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->string('name', 64);
            $table->text('description')->nullable();
            $table->enum('type', ['item', 'package'])->default('item');
            $table->decimal('price', 9, 2);
            $table->decimal('association_discount', 2, 2)->default(0);
            $table->decimal('retail_price', 9, 2)->default(0);
            $table->decimal('report_price', 9, 2)->default(0);
            $table->decimal('cost', 9, 2)->default(0);
            $table->enum('visible', ['public', 'private', 'member'])->default('public');
            $table->enum('status', ['display', 'sale', 'sold', 'pending'])->default('pending');
            $table->boolean('active')->default(true);
            $table->string('vendor_sku')->nullable();
            $table->boolean('anonymous')->default(false);
            $table->integer('matching')->default(1);
            $table->text('association_product')->nullable();
            $table->string('matching_sku', 128)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
