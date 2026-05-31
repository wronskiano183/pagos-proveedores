@if ($lista->isEmpty())
    <p class="text-muted p-3 mb-0">{{ $vacio ?? 'Sin registros.' }}</p>
@else
<div class="table-responsive">
<table class="table table-hover mb-0 align-middle">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Proveedor</th>
            <th>Vence</th>
            <th class="text-end">Total</th>
            <th class="text-end">Saldo</th>
            <th>Estatus</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lista as $factura)
        <tr>
            <td>{{ $factura->folio }}</td>
            <td>{{ $factura->proveedor->nombre }}</td>
            <td>
                {{ $factura->fecha_vencimiento->format('d/m/Y') }}
                @if ($factura->esta_vencida)
                    <span class="badge text-bg-danger">vencida</span>
                @endif
            </td>
            <td class="text-end">${{ number_format($factura->monto_total, 2) }}</td>
            <td class="text-end fw-semibold">${{ number_format($factura->saldo, 2) }}</td>
            <td>@include('facturas._badge', ['estatus' => $factura->estatus])</td>
            <td class="text-end">
                <a href="{{ route('facturas.show', $factura) }}" class="btn btn-sm btn-outline-primary">Ver</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endif
