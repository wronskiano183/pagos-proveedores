<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::withCount('facturas')->orderBy('nombre')->get();

        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        Proveedor::create($this->validar($request));

        return redirect()->route('proveedores.index')->with('ok', 'Proveedor creado correctamente.');
    }

    public function show(Proveedor $proveedor)
    {
        $proveedor->load(['facturas' => fn ($q) => $q->orderBy('fecha_vencimiento')]);

        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $proveedor->update($this->validar($request));

        return redirect()->route('proveedores.index')->with('ok', 'Proveedor actualizado.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')->with('ok', 'Proveedor eliminado.');
    }

    // Reglas de validación compartidas entre crear y actualizar
    private function validar(Request $request): array
    {
        return $request->validate([
            'nombre'    => ['required', 'string', 'max:255'],
            'rfc'       => ['nullable', 'string', 'max:20'],
            'contacto'  => ['nullable', 'string', 'max:255'],
            'telefono'  => ['nullable', 'string', 'max:50'],
            'email'     => ['nullable', 'email', 'max:255'],
            'direccion' => ['nullable', 'string'],
            'notas'     => ['nullable', 'string'],
        ]);
    }
}
