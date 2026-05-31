@extends('layouts.app')
@section('title', 'Nueva factura')

@section('content')
<h1 class="h3 mb-4">Nueva factura</h1>

<form action="{{ route('facturas.store') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">
            @include('facturas._form')
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('facturas.index') }}" class="btn btn-link">Cancelar</a>
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection
