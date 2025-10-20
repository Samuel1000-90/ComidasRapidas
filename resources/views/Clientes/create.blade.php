@extends('layouts.app')

@section('title','Nuevo Cliente')
@section('content')
<h3>Nuevo Cliente</h3>
<form method="POST" action="{{ route('clientes.store') }}">
  @csrf
  <div class="mb-3">
    <label>Nombre</label>
    <input name="nombre" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Teléfono</label>
    <input name="telefono" class="form-control">
  </div>
  <div class="mb-3">
    <label>Dirección</label>
    <input name="direccion" class="form-control">
  </div>
  <div class="mb-3">
    <label>Correo</label>
    <input name="correo" class="form-control" type="email">
  </div>
  <button class="btn btn-primary">Guardar</button>
</form>
@endsection