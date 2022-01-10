<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdviserIdColumnToCustomerSurgery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_surgery', function (Blueprint $table) {
            $table->bigInteger('adviser_id')->after('surgery_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_surgery', function (Blueprint $table) {
            $table->dropColumn('adviser_id');
        });
    }
}
