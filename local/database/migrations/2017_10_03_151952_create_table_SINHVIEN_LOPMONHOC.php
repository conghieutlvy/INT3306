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
        Schema::create('sinhvien_lopmonhoc', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('sinhvien_id')->unsigned();
			$table->integer('lopmonhoc_id')->unsigned();
            $table->timestamps();

            //$table->unique('sinhvien_id', 'lopmonhoc_id');
			$table->foreign('sinhvien_id')->references('id')->on('sinhviens')->onUpdate('cascade');
			$table->foreign('lopmonhoc_id')->references('id')->on('lopmonhocs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinhvien_lopmonhoc');
    }
}
