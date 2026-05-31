<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nombre *</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $proveedor->nombre ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">RFC</label>
        <input type="text" name="rfc" class="form-control" value="{{ old('rfc', $proveedor->rfc ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $proveedor->telefono ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Persona de contacto</label>
        <input type="text" name="contacto" class="form-control" value="{{ old('contacto', $proveedor->contacto ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $proveedor->email ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $proveedor->direccion ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Notas</label>
        <textarea name="notas" class="form-control" rows="2">{{ old('notas', $proveedor->notas ?? '') }}</textarea>
    </div>
</div>
