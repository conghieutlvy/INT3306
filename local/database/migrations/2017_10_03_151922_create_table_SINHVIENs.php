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
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->increments('id');
			$table->string('Họ tên');
			$table->integer('username')->unique();
            $table->date('Ngày sinh');
            $table->string('Lớp khóa học');
			$table->boolean('Kích hoạt')->default(1);	
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
        Schema::dropIfExists('sinhviens');
    }
}
