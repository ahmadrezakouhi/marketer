<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('marketer_id')->unsigned();
            $table->foreign('marketer_id')->references('id')->on('marketers')->onDelete('cascade');
            $table->tinyInteger('level1')->default(5)->nullable();
            $table->tinyInteger('level2')->default(3)->nullable();
            $table->tinyInteger('level3')->default(1)->nullable();
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
        Schema::dropIfExists('commissions');
    }
}
