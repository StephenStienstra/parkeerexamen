<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacties', function (Blueprint $table) {
            $table->id('ID_Parkeerplaats');
            $table->string('kenteken');
            $table->datetime('begintijd')->useCurrent();
            $table->datetime('eindtijd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacties');
    }
};
