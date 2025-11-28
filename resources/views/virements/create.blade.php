@extends('layouts.app')

@section('title', 'Gestion des Virements')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">
            <i class="fas fa-exchange-alt me-2"></i>Gestion des Virements
        </h1>
        <a href="{{ route('virements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouveau Virement
        </a>
    </div>

    <div class="card card-custom shadow">
        <div class="card-header bg-transparent border-bottom">
            <h5 class="card-title mb-0 text-white">
                <i class="fas fa-list me-2"></i>Liste des Virements
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('virements.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="compte_source_id" class="form-label text-white">Compte Source</label>
                    <select name="compte_source_id" id="compte_source_id" class="form-select" required>
                        <option value="">Sélectionner un compte</option>
                        @foreach($comptes as $compte)
                            <option value="{{ $compte->id }}">
                                {{ $compte->RIB }} - {{ $compte->client->nom }} {{ $compte->client->prenom }} ({{ $compte->solde }} €)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="compte_destinataire_id" class="form-label text-white">Compte Destinataire</label>
                    <select name="compte_destinataire_id" id="compte_destinataire_id" class="form-select" required>
                        <option value="">Sélectionner un compte</option>
                        @foreach($comptes as $compte)
                            <option value="{{ $compte->id }}">
                                {{ $compte->RIB }} - {{ $compte->client->nom }} {{ $compte->client->prenom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="montant" class="form-label text-white">Montant</label>
                    <input type="number" name="montant" id="montant" class="form-control" step="0.01" min="0.01" required>
                </div>

                <button type="submit" class="btn btn-success">Effectuer le virement</button>
                <a href="{{ route('virements.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection