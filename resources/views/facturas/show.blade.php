@extends('layouts.app')
@section('title', 'Factura ' . $factura->folio)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Factura {{ $factura->folio }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('facturas.edit', $factura) }}" class="btn btn-outline-secondary">Editar</a>
        <form action="{{ route('facturas.destroy', $factura) }}" method="POST"
              onsubmit="return confirm('¿Eliminar esta factura y sus pagos?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger">Eliminar</button>
        </form>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Proveedor</dt>
                    <dd class="col-sm-8">
                        <a href="{{ route('proveedores.show', $factura->proveedor) }}">{{ $factura->proveedor->nombre }}</a>
                    </dd>
                    <dt class="col-sm-4">Emisión</dt>
                    <dd class="col-sm-8">{{ $factura->fecha_emision->format('d/m/Y') }}</dd>
                    <dt class="col-sm-4">Vencimiento</dt>
                    <dd class="col-sm-8">
                        {{ $factura->fecha_vencimiento->format('d/m/Y') }}
                        @if ($factura->esta_vencida)
                            <span class="badge text-bg-danger">vencida hace {{ abs($factura->dias_para_vencer) }} días</span>
                        @elseif ($factura->saldo > 0)
                            <span class="text-muted">(faltan {{ $factura->dias_para_vencer }} días)</span>
                        @endif
                    </dd>
                    <dt class="col-sm-4">Estatus</dt>
                    <dd class="col-sm-8">@include('facturas._badge', ['estatus' => $factura->estatus])</dd>
                    @if ($factura->notas)
                        <dt class="col-sm-4">Notas</dt>
                        <dd class="col-sm-8">{{ $factura->notas }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Total</span><span>${{ number_format($factura->monto_total, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Pagado</span><span class="text-success">${{ number_format($factura->monto_pagado, 2) }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fs-5 fw-bold">
                    <span>Saldo</span><span>${{ number_format($factura->saldo, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header fw-semibold">Pagos registrados</div>
            <div class="card-body p-0">
                @if ($factura->pagos->isEmpty())
                    <p class="text-muted p-3 mb-0">Todavía no hay pagos.</p>
                @else
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr><th>Fecha</th><th>Método</th><th>Referencia</th><th class="text-end">Monto</th><th></th></tr>
                    </thead>
                    <tbody>
                        @foreach ($factura->pagos as $pago)
                        <tr>
                            <td>{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                            <td>{{ $pago->metodo_pago ?: '—' }}</td>
                            <td>{{ $pago->referencia ?: '—' }}</td>
                            <td class="text-end">${{ number_format($pago->monto, 2) }}</td>
                            <td class="text-end">
                                <form action="{{ route('pagos.destroy', $pago) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este pago?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Eliminar">&times;</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-5">
        @if ($factura->saldo > 0)
        <div class="card">
            <div class="card-header fw-semibold">Registrar pago</div>
            <div class="card-body">
                <form action="{{ route('pagos.store', $factura) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Monto *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" min="0.01" max="{{ $factura->saldo }}"
                                   name="monto" class="form-control" value="{{ old('monto', $factura->saldo) }}" required>
                        </div>
                        <div class="form-text">Saldo pendiente: ${{ number_format($factura->saldo, 2) }}</div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Fecha de pago *</label>
                        <input type="date" name="fecha_pago" class="form-control"
                               value="{{ old('fecha_pago', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Método</label>
                        <select name="metodo_pago" class="form-select">
                            <option value="">—</option>
                            <option>Efectivo</option>
                            <option>Transferencia</option>
                            <option>Cheque</option>
                            <option>Tarjeta</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Referencia</label>
                        <input type="text" name="referencia" class="form-control" value="{{ old('referencia') }}">
                    </div>
                    <button class="btn btn-success w-100">Registrar pago</button>
                </form>
            </div>
        </div>
        @else
        <div class="alert alert-success mb-0">
            <i class="bi bi-check-circle"></i> Esta factura está totalmente pagada.
        </div>
        @endif
    </div>
</div>
@endsection
