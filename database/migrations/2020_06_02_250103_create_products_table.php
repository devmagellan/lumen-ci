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

            $table->string('name', 64);
            $table->text('description')->nullable();
            $table->foreignId('category')->index();
            $table->enum('type', array('item', 'package'))->default('item');
            $table->decimal('price', 9, 2)->nullable();
            $table->decimal('ppp', 9, 2)->nullable();
            $table->decimal('association_discount', 2, 2)->nullable();
            $table->decimal('retail_price', 9, 2)->nullable();
            $table->decimal('report_price', 9, 2)->nullable();
            $table->decimal('cost', 9, 2)->nullable();
            $table->enum('visible', array('public', 'private', 'member'))->default('public');
            $table->enum('status', array('display','sale','sold','private_sale','pending','memo','memo_sale','memo_display','protocol'))->default('pending');
            $table->foreignId('profile_image')->nullable()->index();
            $table->foreignId('member')->nullable()->index();
            $table->foreignId('created_by')->default(0)->index();
            $table->foreignId('modified_by')->default(0)->index();
            $table->boolean('active')->default(1);
            $table->string('vendor_sku', 64)->index();
            $table->string('upc', 128)->index();
            $table->boolean('anonymous')->default(false);
            $table->integer('matching')->default(1);
            $table->string('currency', 3)->default('USD');
            $table->text('association_product')->nullable();
            $table->string('matching_sku', 128);
            $table->integer('original_product')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
