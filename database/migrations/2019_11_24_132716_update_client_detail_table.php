<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_details', function (Blueprint $table) {
            $table->unsignedBigInteger('campaignId')->nullable();
            $table->unsignedBigInteger('marketerId')->nullable();
            $table->string('platform')->nullable();
            $table->foreign('campaignId')->references('id')->on('campaigns');
            $table->foreign('marketerId')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_details');
    }
}
