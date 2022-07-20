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
        Schema::create('room_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');

            $table->foreign('room_id')
            ->references('id')
            ->on('rooms');

            $table->unsignedBigInteger('type_id');

            $table->foreign('type_id')
            ->references('id')
            ->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_type');
    }
};
