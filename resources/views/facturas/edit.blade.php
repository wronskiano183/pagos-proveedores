@extends('layouts.app')
@section('title', 'Editar factura')

@section('content')
<h1 class="h3 mb-4">Editar factura</h1>

<form action="{{ route('facturas.update', $factura) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body">
            @include('facturas._form')
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('facturas.show', $factura) }}" class="btn btn-link">Cancelar</a>
            <button class="btn btn-primary">Actualizar</button>
        </div>
    </div>
</form>
@endsection
