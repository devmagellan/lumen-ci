<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCurrenciesTable.
 */
class CreateCurrenciesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('currencies', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 3);
            $table->string('alpha_3_code', 3)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed', [
            '--class' => CurrencySeeder::class,
        ]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('currencies');
	}
}
