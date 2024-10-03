@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Columna de Contactos -->
        <div class="col-md-4">
            <div class="list-group">
                @foreach ($contacts as $contact)
                    <a href="{{ route('contacts.index', ['contactId' => $contact->id]) }}" 
                       class="list-group-item list-group-item-action {{ $selectedContact && $selectedContact->id == $contact->id ? 'active' : '' }}">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $contact->name }}</h5>
                        </div>
                        <p class="mb-1 text-muted">
                            Last message: {{ $contact->messages->last()->content ?? 'No messages yet' }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Columna de Mensajes -->
        <div class="col-md-8">
            @if ($selectedContact)
                <h3>Messages with {{ $selectedContact->name }}</h3>
                <ul class="list-group">
                    @foreach ($messages as $message)
                        <li class="list-group-item">{{ $message->content }}</li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info" role="alert">
                    Select a contact to view messages
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
