@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifica tu cuenta</div>

                <div class="card-body">   

                    <form method="POST" action="{{ route('verify.code') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="verification_code" class="col-md-4 col-form-label text-md-left">Código de verificación:    </label>

                            <div class="col-md-4">
                                <input id="verification_code" type="text" class="form-control @error('verification_code') is-invalid @enderror" name="verification_code" value="{{ old('verification_code') }}" required autocomplete="verification_code" autofocus>

                                @error('verification_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check"></i> Verificar 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<style>
    .card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .card-header {
        background-color: #007bff; /* Color azul de Bootstrap */
        color: white;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff; 
        border-color: #007bff;
        border-radius: 20px; /* Bordes redondeados */
        transition: all 0.3s ease; /* Transición suave */
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Sombra al pasar el ratón */
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Efecto al enfocar el input */
    }
</style>