<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePositionColumnInFirmUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('firm_user', function (Blueprint $table) {
            $table->dropUnique(['firm_id', 'user_id', 'position']);
            $table->dropColumn('position');
            $table->unsignedBigInteger('firm_id')->change();
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('firm_id')->references('id')->on('firms');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['firm_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('firm_user', function (Blueprint $table) {
            $table->dropUnique(['firm_id', 'user_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['firm_id']);
            $table->unsignedInteger('firm_id')->change();
            $table->unsignedInteger('user_id')->change();
            $table->string('position', 128)->after('user_id');
            $table->unique(['firm_id', 'user_id', 'position']);
        });
    }
}
