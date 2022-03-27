<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    static private $table = 'tb_user';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::$table, function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('nama', 100);
            $table->string('username', 30)->unique()->index();
            $table->text('password');
            $table->foreignId('id_outlet')->references('id')->on('tb_outlet')->onDelete('cascade');
            $table->enum('role', ['admin', 'kasir', 'owner']);
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
        Schema::dropIfExists(self::$table);
    }
}
