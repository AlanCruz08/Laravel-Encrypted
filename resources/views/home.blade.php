@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <p>Bienvenido, {{ auth()->user()->name }}.</p> <!-- Aquí mostramos el nombre del usuario -->
</div>
@endsection
