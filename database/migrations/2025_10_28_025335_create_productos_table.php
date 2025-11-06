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
 public function up(): void
{
    Schema::create('productos', function (Blueprint $table) {
        $table->id('id_producto');
        $table->string('nombre');
        $table->string('categoria')->nullable();
        $table->integer('cantidad')->default(0);
        $table->decimal('precio', 10, 2)->default(0);
        $table->text('descripcion')->nullable();
        $table->timestamp('fecha_registro')->useCurrent();
        $table->unsignedBigInteger('usuario_id')->nullable();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
