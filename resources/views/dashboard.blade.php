@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
<h1 class="h3 mb-4">Resumen</h1>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card text-bg-primary h-100">
            <div class="card-body">
                <div class="text-uppercase small">Adeudo total</div>
                <div class="fs-4 fw-bold">${{ number_format($adeudoTotal, 2) }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="text-uppercase small text-muted">Facturas pendientes</div>
                <div class="fs-4 fw-bold">{{ $facturasPendientes }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-bg-danger h-100">
            <div class="card-body">
                <div class="text-uppercase small">Vencidas</div>
                <div class="fs-4 fw-bold">{{ $vencidas->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="text-uppercase small text-muted">Proveedores</div>
                <div class="fs-4 fw-bold">{{ $totalProveedores }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-danger-subtle fw-semibold">
        <i class="bi bi-exclamation-triangle"></i> Facturas vencidas
    </div>
    <div class="card-body p-0">
        @include('facturas._tabla', ['lista' => $vencidas, 'vacio' => 'No hay facturas vencidas. 🎉'])
    </div>
</div>

<div class="card">
    <div class="card-header bg-warning-subtle fw-semibold">
        <i class="bi bi-clock"></i> Por vencer (próximos 7 días)
    </div>
    <div class="card-body p-0">
        @include('facturas._tabla', ['lista' => $porVencer, 'vacio' => 'Nada por vencer esta semana.'])
    </div>
</div>
@endsection
