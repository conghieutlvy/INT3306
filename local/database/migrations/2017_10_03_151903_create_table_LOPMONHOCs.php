<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLOPMONHOCs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lopmonhocs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('Mã lớp môn học');
			$table->string('Tên lớp môn học');
			$table->boolean('Trạng thái điểm')->default(0);
			$table->integer('hocky_id')->unsigned();
			
            $table->timestamps();
			$table->foreign('hocky_id')->references('id')->on('hockys')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lopmonhocs');
    }
}
