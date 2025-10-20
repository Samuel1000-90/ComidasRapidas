@extends('layouts.app')

@section('title','Clientes')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Clientes</h2>
  <a href="{{ route('clientes.create') }}" class="btn btn-success">Nuevo Cliente</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Correo</th><th>Acciones</th></tr>
  </thead>
  <tbody>
    @forelse($clientes as $c)
    <tr>
      <td>{{ $c->id_cliente }}</td>
      <td>{{ $c->nombre }}</td>
      <td>{{ $c->telefono }}</td>
      <td>{{ $c->correo }}</td>
      <td>
        <a href="{{ route('clientes.edit', $c->id_cliente) }}" class="btn btn-sm btn-warning">Editar</a>
        <form action="{{ route('clientes.destroy', $c->id_cliente) }}" method="POST" style="display:inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
        </form>
      </td>
    </tr>
    @empty
    <tr><td colspan="5">No hay clientes</td></tr>
    @endforelse
  </tbody>
</table>

{{ $clientes->links() }}
@endsection
