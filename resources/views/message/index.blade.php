@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('searchUser') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="contact" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="contact" name="contact" required>
                                <label for="message" class="form-label mt-3">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Enviar mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
