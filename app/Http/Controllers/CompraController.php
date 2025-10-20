<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    // Mostrar lista de compras
    public function index()
    {
        $compras = Compra::with('proveedor')->get();
        return response()->json($compras);
    }

    // Mostrar una compra específica
    public function show($id)
    {
        $compra = Compra::with('proveedor')->find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }
        return response()->json($compra);
    }

    // Crear una nueva compra
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
        ]);

        $compra = Compra::create($validated);
        return response()->json(['message' => 'Compra creada', 'compra' => $compra], 201);
    }

    // Eliminar una compra
    public function destroy($id)
    {
        $compra = Compra::find($id);

        if (!$compra) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        $compra->delete();
        return response()->json(['message' => 'Compra eliminada']);
    }
}
