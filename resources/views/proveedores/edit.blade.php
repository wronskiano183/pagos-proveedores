@extends('layouts.app')
@section('title', 'Editar proveedor')

@section('content')
<h1 class="h3 mb-4">Editar proveedor</h1>

<form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body">
            @include('proveedores._form')
        </div>
        <div class="card-footer d-flex justify-content-between">
            <button type="submit" form="form-eliminar" class="btn btn-outline-danger"
                    onclick="return confirm('¿Eliminar este proveedor y TODAS sus facturas?')">
                Eliminar
            </button>
            <div>
                <a href="{{ route('proveedores.index') }}" class="btn btn-link">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</form>

{{-- Formulario aparte solo para el borrado --}}
<form id="form-eliminar" action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection
