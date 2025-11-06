<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_inventario', function (Blueprint $table) {
    $table->id('id_movimiento');
    $table->unsignedBigInteger('id_producto');
    $table->enum('tipo', ['entrada', 'salida']);
    $table->integer('cantidad');
    $table->text('descripcion')->nullable();
    $table->timestamp('fecha')->useCurrent();
    $table->unsignedBigInteger('Usuario_id_usuario');

    $table->foreign('id_producto')->references('id_producto')->on('producto')->onDelete('cascade');
    $table->foreign('Usuario_id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_inventario');
    }
};
