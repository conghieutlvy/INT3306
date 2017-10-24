<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFILEs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
			$table->string('Đường dẫn');
			$table->integer('lopmonhoc_id')->unsigned();;
			$table->integer('user_id')->unsigned();;
            $table->timestamps();
			
			$table->foreign('lopmonhoc_id')->references('id')->on('lopmonhocs')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('pdts')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
