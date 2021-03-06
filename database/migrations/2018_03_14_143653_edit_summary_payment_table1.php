<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditSummaryPaymentTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('summary_payment', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('department_info_id')->references('id')->on('department_info');
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('summary_payment', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['department_info_id']);
        });
    }
}
