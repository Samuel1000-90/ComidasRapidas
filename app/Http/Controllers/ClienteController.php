<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Mostrar lista de clientes
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json($cliente);
    }

    // Crear un nuevo cliente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:150',
            'correo' => 'nullable|string|email|max:100',
        ]);

        $cliente = Cliente::create($validated);
        return response()->json(['message' => 'Cliente creado', 'cliente' => $cliente], 201);
    }

    // Actualizar un cliente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:150',
            'correo' => 'nullable|string|email|max:100',
        ]);

        $cliente->update($validated);
        return response()->json(['message' => 'Cliente actualizado', 'cliente' => $cliente]);
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $cliente->delete();
        return response()->json(['message' => 'Cliente eliminado']);
    }
}
