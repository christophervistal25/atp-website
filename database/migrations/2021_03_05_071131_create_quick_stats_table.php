<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_stats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surigao_confirmed');
            $table->bigInteger('surigao_recovered');
            $table->bigInteger('surigao_deaths');

            $table->bigInteger('philippines_confirmed');
            $table->bigInteger('philippines_recovered');
            $table->bigInteger('philippines_deaths');

            $table->bigInteger('world_wide_confirmed');
            $table->bigInteger('world_wide_recovered');
            $table->bigInteger('world_wide_deaths');
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
        Schema::dropIfExists('quick_stats');
    }
}
