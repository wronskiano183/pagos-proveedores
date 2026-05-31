@extends('layouts.app')
@section('title', 'Nuevo proveedor')

@section('content')
<h1 class="h3 mb-4">Nuevo proveedor</h1>

<form action="{{ route('proveedores.store') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">
            @include('proveedores._form')
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('proveedores.index') }}" class="btn btn-link">Cancelar</a>
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection
