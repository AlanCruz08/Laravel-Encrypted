@extends('layouts.app') 

@section('content')
    <h1>Chat con {{ $user->name }}</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div id="messages" style="height: 300px; overflow-y: scroll;">
        @foreach ($messages as $message)
            <div class="mb-3 {{ $message->sender_id == auth()->user()->id ? 'text-end' : '' }}">
                <p>
                    <strong>{{ $message->sender->name }}:</strong> 
                    @if ($message->content)
                        {{ Crypt::decrypt($message->content) }}
                    @endif
                </p>
                <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.send', $user) }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" name="message" id="message" class="form-control" placeholder="Escribe tu mensaje...">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
@endsection