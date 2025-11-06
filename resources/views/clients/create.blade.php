@extends('layouts.app')

@section('title', 'Créer un Client')

@section('content')
<div class="content-container my-5 p-4">
    <h2 class="text-white mb-4"><i class="fas fa-user-plus me-2"></i>Créer un Nouveau Client</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.store') }}" method="POST" class="bg-dark p-4 rounded shadow">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label text-white">Nom *</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label text-white">Prénom *</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-white">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Enregistrer
        </button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>

<style>
body {
    background: linear-gradient(to right, #1e1e2f, #2c2c3e);
    min-height: 100vh;
}

.content-container {
    max-width: 600px;
    margin: auto;
}

.form-control:focus {
    border-color: #5233ff;
    box-shadow: 0 0 5px rgba(82, 51, 255, 0.5);
}
</style>
@endsection