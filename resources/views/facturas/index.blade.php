@extends('layouts.app')
@section('title', 'Facturas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Facturas</h1>
    <a href="{{ route('facturas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nueva factura
    </a>
</div>

<div class="btn-group mb-3">
    <a href="{{ route('facturas.index') }}"
       class="btn btn-outline-secondary {{ request('estatus') ? '' : 'active' }}">Todas</a>
    <a href="{{ route('facturas.index', ['estatus' => 'pendiente']) }}"
       class="btn btn-outline-secondary {{ request('estatus') === 'pendiente' ? 'active' : '' }}">Pendientes</a>
    <a href="{{ route('facturas.index', ['estatus' => 'parcial']) }}"
       class="btn btn-outline-secondary {{ request('estatus') === 'parcial' ? 'active' : '' }}">Parciales</a>
    <a href="{{ route('facturas.index', ['estatus' => 'pagada']) }}"
       class="btn btn-outline-secondary {{ request('estatus') === 'pagada' ? 'active' : '' }}">Pagadas</a>
</div>

<div class="card">
    <div class="card-body p-0">
        @include('facturas._tabla', ['lista' => $facturas, 'vacio' => 'No hay facturas con ese filtro.'])
    </div>
</div>
@endsection
