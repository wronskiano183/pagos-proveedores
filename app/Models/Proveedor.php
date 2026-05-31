<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;

    // El plural "natural" de proveedor no es proveedors asi que lo fijamos
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre', 'rfc', 'contacto', 'telefono', 'email', 'direccion', 'notas',
    ];

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class);
    }


    // Adeudo total del proveedor = suma de los saldos pendientes de sus facturas
    // Uso $proveedor->saldo_total

    public function getSaldoTotalAttribute(): float
    {
        return round($this->facturas->sum(fn (Factura $f) => $f->saldo), 2);
    }
}
