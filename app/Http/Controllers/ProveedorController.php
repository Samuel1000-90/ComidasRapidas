<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    // Mostrar lista de proveedores
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json($proveedores);
    }

    // Mostrar un proveedor específico
    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }
        return response()->json($proveedor);
    }

    // Crear un nuevo proveedor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:150',
            'correo' => 'nullable|string|email|max:100',
        ]);

        $proveedor = Proveedor::create($validated);
        return response()->json(['message' => 'Proveedor creado', 'proveedor' => $proveedor], 201);
    }

    // Actualizar un proveedor
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:150',
            'correo' => 'nullable|string|email|max:100',
        ]);

        $proveedor->update($validated);
        return response()->json(['message' => 'Proveedor actualizado', 'proveedor' => $proveedor]);
    }

    // Eliminar un proveedor
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        $proveedor->delete();
        return response()->json(['message' => 'Proveedor eliminado']);
    }
}
