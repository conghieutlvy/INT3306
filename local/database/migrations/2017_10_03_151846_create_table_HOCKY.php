<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHOCKY extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HOCKY', function (Blueprint $table) {
            $table->increments('id');
			$table->string('HOC KY');
			$table->integer('NAMHOC_id')->unsigned();
            $table->timestamps();
			
			$table->foreign('NAMHOC_id')->references('id')->on('NAMHOC')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HOCKY');
    }
}
