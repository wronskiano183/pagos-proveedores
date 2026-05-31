<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function store(Request $request, Factura $factura)
    {
        $data = $request->validate([
            // El pago no puede exceder el saldo pendiente
            'monto'       => ['required', 'numeric', 'min:0.01', 'max:' . max($factura->saldo, 0.01)],
            'fecha_pago'  => ['required', 'date'],
            'metodo_pago' => ['nullable', 'string', 'max:50'],
            'referencia'  => ['nullable', 'string', 'max:255'],
            'notas'       => ['nullable', 'string'],
        ], [
            'monto.max' => 'El pago no puede ser mayor al saldo pendiente ($' . number_format($factura->saldo, 2) . ').',
        ]);

        // Al crear el pago el modelo Pago recalcula solo el estatus de la factura
        $factura->pagos()->create($data);

        return redirect()->route('facturas.show', $factura)->with('ok', 'Pago registrado.');
    }

    public function destroy(Pago $pago)
    {
        $factura = $pago->factura;
        $pago->delete(); // esto tambien vuelve a recalcular el estatus de la factura

        return redirect()->route('facturas.show', $factura)->with('ok', 'Pago eliminado.');
    }
}
