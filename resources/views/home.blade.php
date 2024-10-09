@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">
            <div class="row">
                <!-- Lista de contactos -->
                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                    <h5 class="font-weight-bold mb-3 text-center text-lg-start">Chats</h5>
                    <a href="{{ route('new.message') }}" class="btn btn-primary d-block mx-auto mb-4">Enviar mensaje</a>
                    <div class="card">
                        <div class="card-body">
                            @if ($contactos->isEmpty())
                                <p class="text-center">Prueba a iniciar una conversacion</p>
                                <a href="{{ route('new.message') }}" class="btn btn-primary d-block mx-auto">Enviar
                                    mensaje</a>
                            @endif
                            <ul class="list-unstyled mb-0">
                                @foreach ($contactos as $contacto)
                                    <li class="p-2 border-bottom {{ $loop->first ? 'bg-body-tertiary' : '' }}">
                                        <a href="{{ route('conversation', $contacto['id']) }}" class="d-flex justify-content-between">
                                            <div class="d-flex flex-row">
                                                <div class="pt-1">
                                                    <p class="fw-bold mb-0">{{ $contacto['name'] }}
                                                    </p>
                                                    <p class="small text-muted">{{ Str::limit($contacto['message'], 30) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="pt-1">
                                                <p class="small text-muted mb-1">{{ $contacto['hour'] }}</p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Conversación con un contacto -->
                <div class="col-md-6 col-lg-7 col-xl-8">
                    <h5 class="font-weight-bold mb-3 text-center text-lg-start">
                        Conversación con
                        {{ $selectedContact ? $selectedContact->name : 'Seleccione un contacto' }}
                    </h5>
                    <div class="card">
                        <div class="card-body">
                            @if ($selectedContact)
                                <div class="messages-list" style="max-height: 400px; overflow-y: auto;">
                                    @foreach ($mensajes as $mensaje)
                                        <div
                                            class="card mb-2 {{ $mensaje->sender_id === Auth::id() ? 'bg-primary text-white' : 'bg-light' }}">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="fw-bold mb-1">
                                                            {{ $mensaje->sender_id === Auth::id() ? 'Tú' : $selectedContact->name }}
                                                        </h6>
                                                        <p class="mb-0">{{ $mensaje->content }}</p>
                                                    </div>
                                                    <div class="text-end">
                                                        <p class="small text-muted mb-0">
                                                            {{ $mensaje->created_at->format('H:i') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-center">Selecciona un contacto para iniciar la conversación.</p>
                            @endif
                        </div>
                    </div>

                    @if ($selectedContact)
                        <div class="card mt-4">
                            <div class="card-body">
                                <form action="{{ route('sendMessage', $selectedContact->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="message" class="form-control"
                                            placeholder="Escribe un mensaje..." required>
                                        <button class="btn btn-primary" type="submit">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection


<style>
    .card {
        border-radius: 15px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 20px
    }

    .card-header {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }
</style>
