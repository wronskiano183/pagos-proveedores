<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [ //fillable es para protejer estas columnas
        'proveedor_id', 'folio', 'fecha_emision', 'fecha_vencimiento',
        'monto_total', 'estatus', 'notas',
    ];

    protected $casts = [ //casts ees para decirle como debe tratar los datos cuado los saca
        'fecha_emision'     => 'date',
        'fecha_vencimiento' => 'date',
        'monto_total'       => 'decimal:2',
    ];

    public function proveedor(): BelongsTo //BelongsTo es pertenece a ára indicar que una factira tiene un solo proovedor no puede tener multiples
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function pagos(): HasMany //para decir que la factura tiene muchos pagos asociados por si se hace en abonos
    {
        return $this->hasMany(Pago::class);
    }

    // Total ya abonado a esta factura -> $factura->monto_pagado
    public function getMontoPagadoAttribute(): float
    {
        return round((float) $this->pagos->sum('monto'), 2);
    }

    // Lo que falta por pagar -> $factura->saldo
    public function getSaldoAttribute(): float
    {
        return round((float) $this->monto_total - $this->monto_pagado, 2);
    }

    // ya paso la fecha y todavia debe -> $factura->esta_vencida
    public function getEstaVencidaAttribute(): bool
    {
        return $this->saldo > 0 && $this->fecha_vencimiento->isPast();
    }

    // Dias restantes (negativo = vencida hace X días) -> $factura->dias_para_vencer
    public function getDiasParaVencerAttribute(): int
    {
        return (int) now()->startOfDay()->diffInDays($this->fecha_vencimiento, false);
    }


     //la loggica de negocios


    // Recalcula el estatus segun los pagos registrados
    public function actualizarEstatus(): void
    {
        $this->estatus = match (true) {
            $this->saldo <= 0          => 'pagada',
            $this->monto_pagado > 0    => 'parcial',
            default                    => 'pendiente',
        };
        $this->saveQuietly(); // sin disparar eventos otra vez
    }


    // Scopes sojn filtros reutilizables es como decir busca las factuiras pendientes o vencidas

    public function scopePendientes(Builder $query): Builder
    {
        return $query->where('estatus', '!=', 'pagada');
    }

    public function scopeVencidas(Builder $query): Builder
    {
        return $query->where('estatus', '!=', 'pagada')
                     ->whereDate('fecha_vencimiento', '<', now());
    }

    // Proximas a vencer dentro de N dias (default 7)
    public function scopePorVencer(Builder $query, int $dias = 7): Builder
    {
        return $query->where('estatus', '!=', 'pagada')
                     ->whereDate('fecha_vencimiento', '>=', now())
                     ->whereDate('fecha_vencimiento', '<=', now()->addDays($dias));
    }
}
