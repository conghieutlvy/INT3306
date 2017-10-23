<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSINHVIENs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SINHVIENs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('Tên');
			$table->integer('username')->unique();
            $table->datetime('Ngày sinh');
            $table->string('Lớp khóa học');	
			$table->rememberToken();
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
        Schema::dropIfExists('SINHVIENs');
    }
}
