<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [//fillable es para protejer estas columnas
        'factura_id', 'monto', 'fecha_pago', 'metodo_pago', 'referencia', 'notas',
    ];

    protected $casts = [//como debe tratar los datos
        'fecha_pago' => 'date',
        'monto'      => 'decimal:2',
    ];

    public function factura(): BelongsTo
    {
        return $this->belongsTo(Factura::class);
    }


     // Cada vez que se crea, edita o borra un pago, la factura
     // recalcula su saldo y estatus automaticamente

    protected static function booted(): void
    {
        static::saved(fn (Pago $pago)   => $pago->factura?->actualizarEstatus());
        static::deleted(fn (Pago $pago) => $pago->factura?->actualizarEstatus());
    }
}
