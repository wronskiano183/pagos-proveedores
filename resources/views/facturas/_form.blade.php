@php
    // Preselecciona el proveedor si viene en la URL (?proveedor_id=) o al editar
    $preProveedor = old('proveedor_id', $factura->proveedor_id ?? request('proveedor_id'));
@endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Proveedor *</label>
        <select name="proveedor_id" class="form-select" required>
            <option value="">— Selecciona —</option>
            @foreach ($proveedores as $prov)
                <option value="{{ $prov->id }}" {{ (string) $preProveedor === (string) $prov->id ? 'selected' : '' }}>
                    {{ $prov->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Folio / N.º de factura *</label>
        <input type="text" name="folio" class="form-control" value="{{ old('folio', $factura->folio ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Fecha de emisión *</label>
        <input type="date" name="fecha_emision" class="form-control"
               value="{{ old('fecha_emision', isset($factura) ? $factura->fecha_emision->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Fecha de vencimiento *</label>
        <input type="date" name="fecha_vencimiento" class="form-control"
               value="{{ old('fecha_vencimiento', isset($factura) ? $factura->fecha_vencimiento->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Monto total *</label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" step="0.01" min="0" name="monto_total" class="form-control"
                   value="{{ old('monto_total', $factura->monto_total ?? '') }}" required>
        </div>
    </div>
    <div class="col-12">
        <label class="form-label">Notas</label>
        <textarea name="notas" class="form-control" rows="2">{{ old('notas', $factura->notas ?? '') }}</textarea>
    </div>
</div>
