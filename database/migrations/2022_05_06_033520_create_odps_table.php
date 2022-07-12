<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odps', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('olt_id');
        $table->foreign('olt_id')->references('id')->on('olts')->onDelete('cascade')->onUpdate('cascade');
        $table->string('nama');
        $table->string('alamat');
        $table->string('port');
        $table->string('terpakai');
        $table->string('total');
        $table->string('latitude');
        $table->string('longitude');
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
        Schema::dropIfExists('odps');
    }
}
