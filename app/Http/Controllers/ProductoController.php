<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar lista de productos
    public function index()
    {
        $productos = Producto::with('proveedor')->get();
        return response()->json($productos);
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::with('proveedor')->find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($producto);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'categoria' => 'nullable|string|max:50',
            'stock' => 'nullable|integer',
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
        ]);

        $producto = Producto::create($validated);
        return response()->json(['message' => 'Producto creado', 'producto' => $producto], 201);
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'categoria' => 'nullable|string|max:50',
            'stock' => 'nullable|integer',
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
        ]);

        $producto->update($validated);
        return response()->json(['message' => 'Producto actualizado', 'producto' => $producto]);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();
        return response()->json(['message' => 'Producto eliminado']);
    }
}
