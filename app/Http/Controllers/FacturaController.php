<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index(Request $request)
    {
        $query = Factura::with('proveedor')->orderBy('fecha_vencimiento');

        // Filtro opcional por estatus (?estatus=pendiente|parcial|pagada)
        if ($request->filled('estatus')) {
            $query->where('estatus', $request->estatus);
        }

        $facturas = $query->get();

        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        return view('facturas.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        // El estatus arranca en "pendiente" (valor por defecto de la migracion) por que solo puedes iniciar asi
        Factura::create($this->validar($request));

        return redirect()->route('facturas.index')->with('ok', 'Factura registrada.');
    }

    public function show(Factura $factura)
    {
        $factura->load(['proveedor', 'pagos' => fn ($q) => $q->orderBy('fecha_pago')]);

        return view('facturas.show', compact('factura'));
    }

    public function edit(Factura $factura)
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        return view('facturas.edit', compact('factura', 'proveedores'));
    }

    public function update(Request $request, Factura $factura)
    {
        $factura->update($this->validar($request));
        $factura->actualizarEstatus(); // por si cambio el monto total

        return redirect()->route('facturas.show', $factura)->with('ok', 'Factura actualizada.');
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();

        return redirect()->route('facturas.index')->with('ok', 'Factura eliminada.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'proveedor_id'      => ['required', 'exists:proveedores,id'],
            'folio'             => ['required', 'string', 'max:255'],
            'fecha_emision'     => ['required', 'date'],
            'fecha_vencimiento' => ['required', 'date', 'after_or_equal:fecha_emision'],
            'monto_total'       => ['required', 'numeric', 'min:0'],
            'notas'             => ['nullable', 'string'],
        ]);
    }
}
