<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLOPMONHOC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LOPMONHOC', function (Blueprint $table) {
            $table->increments('id');
			$table->string('LOP MON HOC');
			$table->integer('HOCKY_id')->unsigned();
			$table->integer('GIANGVIEN_id')->unsigned();
            $table->timestamps();
			
			$table->foreign('HOCKY_id')->references('id')->on('HOCKY')->onDelete('cascade');
			$table->foreign('GIANGVIEN_id')->references('id')->on('GIANGVIENs')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LOPMONHOC');
    }
}
