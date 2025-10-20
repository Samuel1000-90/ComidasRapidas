<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Mostrar lista de pedidos
    public function index()
    {
        // Traemos pedidos con cliente y detalle (productos)
        $pedidos = Pedido::with(['cliente', 'detallePedidos.producto'])->get();

        return response()->json($pedidos);
    }

    // Mostrar un pedido específico
    public function show($id)
    {
        $pedido = Pedido::with(['cliente', 'detallePedidos.producto'])->find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        return response()->json($pedido);
    }

    // Crear nuevo pedido
    public function store(Request $request)
    {
        // Validar datos básicos
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'detalle' => 'required|array|min:1',
            'detalle.*.id_producto' => 'required|exists:productos,id_producto',
            'detalle.*.cantidad' => 'required|integer|min:1',
        ]);

        // Crear pedido
        $pedido = new Pedido();
        $pedido->id_cliente = $validated['id_cliente'];
        $pedido->fecha = now();
        $pedido->estado = 'Pendiente';
        $pedido->total = 0; // Lo calcularemos abajo
        $pedido->save();

        $total = 0;

        // Crear detalle del pedido
        foreach ($validated['detalle'] as $item) {
            $producto = \App\Models\Producto::find($item['id_producto']);
            $subtotal = $producto->precio * $item['cantidad'];

            DetallePedido::create([
                'id_pedido' => $pedido->id_pedido,
                'id_producto' => $producto->id_producto,
                'cantidad' => $item['cantidad'],
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        // Actualizar total del pedido
        $pedido->total = $total;
        $pedido->save();

        return response()->json(['message' => 'Pedido creado', 'pedido' => $pedido], 201);
    }

    // Actualizar estado de un pedido
    public function update(Request $request, $id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $validated = $request->validate([
            'estado' => 'required|in:Pendiente,Preparando,Entregado,Cancelado',
        ]);

        $pedido->estado = $validated['estado'];
        $pedido->save();

        return response()->json(['message' => 'Estado actualizado', 'pedido' => $pedido]);
    }

    // Eliminar pedido
    public function destroy($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $pedido->delete();

        return response()->json(['message' => 'Pedido eliminado']);
    }
}
