@extends('layouts.app')

@section('title','Editar Cliente')
@section('content')
<h3>Editar Cliente</h3>
<form method="POST" action="{{ route('clientes.update', $cliente->id_cliente) }}">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Nombre</label>
    <input name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
  </div>
  <div class="mb-3">
    <label>Teléfono</label>
    <input name="telefono" class="form-control" value="{{ $cliente->telefono }}">
  </div>
  <div class="mb-3">
    <label>Dirección</label>
    <input name="direccion" class="form-control" value="{{ $cliente->direccion }}">
  </div>
  <div class="mb-3">
    <label>Correo</label>
    <input name="correo" class="form-control" value="{{ $cliente->correo }}" type="email">
  </div>
  <button class="btn btn-primary">Actualizar</button>
</form>
@endsection
