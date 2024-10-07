@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Bienvenido, {{ auth()->user()->name }}.</div> <!-- Aquí mostramos el nombre del usuario -->
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
                <li class="p-2 border-bottom bg-body-tertiary">
                  <a href="#!" class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar"
                        class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                      <div class="pt-1">
                        <p class="fw-bold mb-0">John Doe</p>
                        <p class="small text-muted">Hello, Are you there?</p>
                      </div>
                    </div>
                    <div class="pt-1">
                      <p class="small text-muted mb-1">Just now</p>
                      <span class="badge bg-danger float-end">1</span>
                    </div>
                  </a>
                </li>
                <li class="p-2 border-bottom">
                  <a href="#!" class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-1.webp" alt="avatar"
                        class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                      <div class="pt-1">
                        <p class="fw-bold mb-0">Danny Smith</p>
                        <p class="small text-muted">Lorem ipsum dolor sit.</p>
                      </div>
                    </div>
                    <div class="pt-1">
                      <p class="small text-muted mb-1">5 mins ago</p>
                    </div>
                  </a>
                </li>
                <li class="p-2 border-bottom">
                  <a href="#!" class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-2.webp" alt="avatar"
                        class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                      <div class="pt-1">
                        <p class="fw-bold mb-0">Alex Steward</p>
                        <p class="small text-muted">Lorem ipsum dolor sit.</p>
                      </div>
                    </div>
                    <div class="pt-1">
                      <p class="small text-muted mb-1">Yesterday</p>
                    </div>
                  </a>
                </li>
                <li class="p-2 border-bottom">
                  <a href="#!" class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-3.webp" alt="avatar"
                        class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                      <div class="pt-1">
                        <p class="fw-bold mb-0">Ashley Olsen</p>
                        <p class="small text-muted">Lorem ipsum dolor sit.</p>
                      </div>
                    </div>
                    <div class="pt-1">
                      <p class="small text-muted mb-1">Yesterday</p>
                    </div>
                  </a>
                </li>
                <li class="p-2 border-bottom">
                  <a href="#!" class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-4.webp" alt="avatar"
                        class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                      <div class="pt-1">
                        <p class="fw-bold mb-0">Kate Moss</p>
                        <p class="small text-muted">Lorem ipsum dolor sit.</p>
                      </div>
                    </div>
                    <div class="pt-1">
                      <p class="small text-muted mb-1">Yesterday</p>
                    </div>
                  </a>
                </li>
                <li class="p-2 border-bottom">
                  <a href="#!" class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
                        class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                      <div class="pt-1">
                        <p class="fw-bold mb-0">Lara Croft</p>
                        <p class="small text-muted">Lorem ipsum dolor sit.</p>
                      </div>
                    </div>
                    <div class="pt-1">
                      <p class="small text-muted mb-1">Yesterday</p>
                    </div>
                  </a>
                </li>
                <li class="p-2">
                  <a href="#!" class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                        class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                      <div class="pt-1">
                        <p class="fw-bold mb-0">Brad Pitt</p>
                        <p class="small text-muted">Lorem ipsum dolor sit.</p>
                      </div>
                    </div>
                    <div class="pt-1">
                      <p class="small text-muted mb-1">5 mins ago</p>
                      <span class="text-muted float-end"><i class="fas fa-check" aria-hidden="true"></i></span>
                    </div>
                  </a>
                </li>
              </ul>
  
            </div>
          </div>

          {{--}} ASI SERIA MAS O MENOS CON DATOS
          <div class="card">
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    */7@foreach ($contactos as $contacto)*/
                    <li class="p-2 border-bottom */7{{ $loop->first ? 'bg-body-tertiary' : '' }}*//">
                        <a href="#!" class="d-flex justify-content-between">
                            <div class="d-flex flex-row">
                                <img src="{{ $contacto->avatar }}" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                <div class="pt-1">
                                    <p class="fw-bold   
         mb-0">{{ $contacto->nombre }}</p>
                                    <p class="small text-muted">{{ Str::limit($contacto->mensaje, 30) }}</p>
                                </div>
                            </div>
                            <div class="pt-1">
                                <p class="small text-muted mb-1">{{ $contacto->hora }}</p>
                                @if ($contacto->tiene_mensajes_sin_leer)
                                <span class="badge bg-danger float-end">{{ $contacto->mensajes_sin_leer }}</span>
                                @endif
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{--}}
        </div>
  
        <div class="col-md-6 col-lg-7 col-xl-8">
  
            <h5 class="font-weight-bold mb-3 text-center text-lg-start">Conversacion</h5>
          <ul class="list-unstyled">
            <li class="d-flex justify-content-between mb-4">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
              <div class="card">
                <div class="card-header d-flex justify-content-between p-3">
                  <p class="fw-bold mb-0">Brad Pitt</p>
                  <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                </div>
                <div class="card-body">
                  <p class="mb-0">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.
                  </p>
                </div>
              </div>
            </li>
            <li class="d-flex justify-content-between mb-4">
              <div class="card w-100">
                <div class="card-header d-flex justify-content-between p-3">
                  <p class="fw-bold mb-0">Lara Croft</p>
                  <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                </div>
                <div class="card-body">
                  <p class="mb-0">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                    laudantium.
                  </p>
                </div>
              </div>
              <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
                class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
            </li>
            <li class="d-flex justify-content-between mb-4">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
              <div class="card">
                <div class="card-header d-flex justify-content-between p-3">
                  <p class="fw-bold mb-0">Brad Pitt</p>
                  <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
                </div>
                <div class="card-body">
                  <p class="mb-0">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.
                  </p>
                </div>
              </div>
            </li>
            <li class="bg-white mb-3">
              <div data-mdb-input-init class="form-outline">
                <textarea class="form-control bg-body-tertiary" id="textAreaExample2" rows="4"></textarea>
                <label class="form-label" for="textAreaExample2">Message</label>
              </div>
            </li>
            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-rounded float-end">Send</button>
          </ul>
  
        </div>
        {{--}} ASI SERIA MAS O MENOS CON DATOS LA PARTE DEL CHAT EN SÍ
            <div class="card">
    <div class="card-body">
        <ul class="list-unstyled mb-0">
            @foreach ($mensajes as $mensaje)
            <li class="p-2 border-bottom {{ $loop->first ? 'bg-body-tertiary' : '' }}">
                <a href="{{ route('mensajes.show', $mensaje->id) }}" class="d-flex justify-content-between"> 
                    <div class="d-flex flex-row">
                        <img src="{{ $mensaje->remitente->avatar }}" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                        <div class="pt-1">
                            <p class="fw-bold mb-0">{{ $mensaje->remitente->nombre }}</p> 
                            <p class="small text-muted">{{ Str::limit($mensaje->contenido, 30) }}</p> 
                        </div>
                    </div>
                    <div class="pt-1">
                        <p class="small text-muted mb-1">{{ $mensaje->created_at->diffForHumans() }}</p> 
                        @if ($mensaje->no_leido)
                        <span class="badge bg-danger float-end">Nuevo</span> 
                        @endif
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
        {{--}}

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
        background-color: #007bff; /* Color azul de Bootstrap */
        color: white;
        font-weight: bold;
    }
</style>