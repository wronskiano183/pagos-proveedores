@extends('layouts.app')
@section('title', 'Proveedores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Proveedores</h1>
    <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo proveedor
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        @if ($proveedores->isEmpty())
            <p class="text-muted p-3 mb-0">Aún no hay proveedores. Crea el primero.</p>
        @else
        <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th class="text-center">Facturas</th>
                    <th class="text-end">Adeudo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $p)
                <tr>
                    <td class="fw-semibold">{{ $p->nombre }}</td>
                    <td>{{ $p->telefono ?: '—' }}</td>
                    <td class="text-center">{{ $p->facturas_count }}</td>
                    <td class="text-end">${{ number_format($p->saldo_total, 2) }}</td>
                    <td class="text-end">
                        <a href="{{ route('proveedores.show', $p) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                        <a href="{{ route('proveedores.edit', $p) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @endif
    </div>
</div>
@endsection
