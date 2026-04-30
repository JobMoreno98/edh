@extends('layouts.layout_general')

@section('contenido')

    <h1>Admin Login</h1><br>

    <div class="form-floating mb-3">
  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Usuario</label>
</div>
<div class="form-floating">
  <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
  <label for="floatingPassword">Contraseña</label>
</div>

    


@endsection