@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('verify.code') }}">
        @csrf
        <label for="verification_code">Introduce tu código de verificación:</label>
        <input type="text" name="verification_code" id="verification_code" required>
        <button type="submit">Verificar</button>
    </form>
</div>
@endsection
