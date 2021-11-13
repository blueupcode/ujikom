<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailTable extends Migration
{
    static private $table = 'tb_detail_transaksi';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::$table, function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->references('id')->on('tb_transaksi')->onDelete('cascade');
            $table->foreignId('id_paket')->references('id')->on('tb_paket')->onDelete('cascade');
            $table->integer('qty');
            $table->text('keterangan')->nullable();
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
