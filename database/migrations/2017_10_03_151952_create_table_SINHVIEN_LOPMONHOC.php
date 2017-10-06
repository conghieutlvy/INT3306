<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSINHVIENLOPMONHOC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SINHVIEN_LOPMONHOC', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('SINHVIEN_id')->unsigned();
			$table->integer('LOPMONHOC_id')->unsigned();
            $table->timestamps();
			
			$table->foreign('SINHVIEN_id')->references('id')->on('SINHVIENs')->onDelete('cascade');
			$table->foreign('LOPMONHOC_id')->references('id')->on('LOPMONHOC')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SINHVIEN_LOPMONHOC');
    }
}
