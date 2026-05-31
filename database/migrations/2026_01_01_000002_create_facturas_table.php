<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')
                  ->constrained('proveedores') //no tiene el$ por que es un ecadenamiento de metodos por qwue develven el mismo objeto
                  ->cascadeOnDelete();          // si borro el proveedor se borran sus facturas
            $table->string('folio');             // numero de factura del proveedor
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->decimal('monto_total', 12, 2);
            $table->string('estatus')->default('pendiente'); // pendiente | parcial | pagada
            $table->text('notas')->nullable();
            $table->timestamps();

            // Índices para que el dashboard de vencimientos sea rápido
            $table->index('fecha_vencimiento');
            $table->index('estatus');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
