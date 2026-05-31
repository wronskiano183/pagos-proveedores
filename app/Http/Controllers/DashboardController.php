<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Proveedor;

class DashboardController extends Controller
{
    public function index()
    {
        // Suma de saldos de todas las facturas no pagadas
        $adeudoTotal = Factura::pendientes()->get()->sum(fn (Factura $f) => $f->saldo);

        $vencidas  = Factura::vencidas()->with('proveedor')->orderBy('fecha_vencimiento')->get();
        $porVencer = Factura::porVencer(7)->with('proveedor')->orderBy('fecha_vencimiento')->get();

        $facturasPendientes = Factura::pendientes()->count();
        $totalProveedores   = Proveedor::count();

        return view('dashboard', compact(
            'adeudoTotal', 'vencidas', 'porVencer', 'facturasPendientes', 'totalProveedores'
        ));
    }
}
