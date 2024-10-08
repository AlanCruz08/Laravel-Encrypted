@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <p class="h1">Aqui estara la interfaz de conversacion</p>
            @foreach ($messages as $message)
                <div class="">
                    <h1>{{ $message->content }}</h1>
                </div>
                
            @endforeach
        </div>
    </div>
</div>
@endsection