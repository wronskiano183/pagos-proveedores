@extends('layouts.app')
@section('title', $proveedor->nombre)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">{{ $proveedor->nombre }}</h1>
    <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-outline-secondary">Editar</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">RFC</dt><dd class="col-sm-9">{{ $proveedor->rfc ?: '—' }}</dd>
                    <dt class="col-sm-3">Contacto</dt><dd class="col-sm-9">{{ $proveedor->contacto ?: '—' }}</dd>
                    <dt class="col-sm-3">Teléfono</dt><dd class="col-sm-9">{{ $proveedor->telefono ?: '—' }}</dd>
                    <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $proveedor->email ?: '—' }}</dd>
                    <dt class="col-sm-3">Dirección</dt><dd class="col-sm-9">{{ $proveedor->direccion ?: '—' }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-primary h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="text-uppercase small">Adeudo total</div>
                <div class="fs-3 fw-bold">${{ number_format($proveedor->saldo_total, 2) }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Facturas</span>
        <a href="{{ route('facturas.create', ['proveedor_id' => $proveedor->id]) }}" class="btn btn-sm btn-primary">
            Nueva factura
        </a>
    </div>
    <div class="card-body p-0">
        @include('facturas._tabla', ['lista' => $proveedor->facturas, 'vacio' => 'Este proveedor no tiene facturas.'])
    </div>
</div>
@endsection
