@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <p class="h1">Bienvenido a la aplicación de Mensajes encriptados</p>
            <p class="lead">En esta aplicación podrás enviar mensajes encriptados a tus amigos y familiares.</p>
            <p>Para comenzar, inicia una conversacion.</p>
            @csrf
            <a href="{{ route('messages.index') }}" class="btn btn-primary">Iniciar conversación</a>
        </div>
    </div>
</div>
@endsection
