@extends('layouts.app')

@section('content')


<div class="container">
    <div class="card">
        <div class="card-header">Bienvenido, {{ auth()->user()->name }}.</div> 
    </div>
</div>

<section>
    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                <h5 class="font-weight-bold mb-3 text-center text-lg-start">Chats</h5>
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach ($contactos as $contacto)
                                <li class="p-2 border-bottom {{ $loop->first ? 'bg-body-tertiary' : '' }}">
                                    <a href="{{ route('chat.show', $contacto->id) }}" class="d-flex justify-content-between"> 
                                        <div class="d-flex flex-row">
                                            <img src="{{ asset('img/user.png') }}" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                            <div class="pt-1">
                                                <p class="fw-bold mb-0">{{ $contacto->name }}</p> 
                                                <p class="small text-muted mb-1">
                                                    {{ $contacto->lastMessage ? Str::limit(Crypt::decrypt($contacto->lastMessage), 20) : 'Sin mensajes' }}
                                                </p>    
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <p class="small text-muted mb-1">{{ $contacto->hora }}</p> 
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-7 col-xl-8">
                <h1 class="mb-4">Chat con <span class="text-primary">{{ $user->name }}</span></h1>
            
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            
                <div id="messages" class="border rounded p-3" style="height: 300px; overflow-y: auto; background-color: #f8f9fa;">
                    @foreach ($messages as $message)
                        <div class="mb-3 {{ $message->sender_id == auth()->user()->id ? 'text-end' : '' }}" data-message-id="{{ $message->id }}"> 
                            <p class="mb-1">
                                <strong>{{ $message->sender->name }}:</strong> 
                                @if ($message->content)
                                    {{ Crypt::decrypt($message->content) }}
                                @else
                                    <em class="text-muted">Sin contenido</em>
                                @endif
                            </p>
                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach
                </div>
            
                <form action="{{ route('chat.send', $user) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="message" id="message" class="form-control" placeholder="Escribe tu mensaje..." required>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>

                <script>
                setInterval(function() {
                    $.ajax({
                        // ...
                        success: function(response) {
                            // Convertir la respuesta HTML a un objeto jQuery
                            const $newMessages = $("<div>").html(response).find("#messages > div"); 

                            // Recorrer los mensajes nuevos
                            $newMessages.each(function() {
                                const messageId = $(this).data("message-id"); // Obtener el ID del mensaje
                                if ($("#messages > div[data-message-id='" + messageId + "']").length === 0) {
                                    // Si el mensaje no existe, agregarlo al div
                                    $("#messages").append($(this)); 
                                }
                            });
                        },
                        // ...
                    });
                }, 6000); 
                </script>
            </div>

        </div>
    </div>
</section>

@endsection
<style>
    .card {
    border-radius: 15px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
    font-size: 20px
    }
    .card-header {
        background-color: #007bff; 
        color: white;
        font-weight: bold;
    }
</style>