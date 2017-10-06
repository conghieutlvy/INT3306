<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFILE extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FILE', function (Blueprint $table) {
            $table->increments('id');
			$table->string('PATH');
			$table->integer('LOPMONHOC_id')->unsigned();;
			$table->integer('USER_id')->unsigned();;
            $table->timestamps();
			
			$table->foreign('LOPMONHOC_id')->references('id')->on('LOPMONHOC')->onDelete('cascade');
			$table->foreign('USER_id')->references('id')->on('PDTs')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FILE');
    }
}
